<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;

class RecipeService
{
    protected $converter;

    public function __construct()
    {
        $config = [
            'default_attributes' => [
                Heading::class => [
                    'class' => static function (Heading $node) {
                        return $node->getLevel() === 2 ? 'mb-3' : null;
                    },
                ],
                ListBlock::class => [
                    'class' => 'mb-4',
                ],
                ListItem::class => [
                    'class' => 'mb-1',
                ],
                Link::class => [
                    'class' => 'btn btn-link',
                    'target' => '_blank',
                ],
            ],
        ];
        
        $environment = new Environment($config);

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AttributesExtension());
        $environment->addExtension(new FrontMatterExtension());
        $environment->addExtension(new DefaultAttributesExtension());
        
        $this->converter = new MarkdownConverter($environment);
    }

    public function parseRecipe($filename)
    {
        $markdownPath = resource_path('markdown/recipes/' . $filename);

        if (!File::exists($markdownPath)) {
            // Handle the case where the file doesn't exist
            return null;
        }

        $markdown = File::get($markdownPath);
        $result = $this->converter->convert($markdown);

        if ($result instanceof RenderedContentWithFrontMatter) {
            $metadata = $result->getFrontMatter();
            $htmlContent = $result->getContent();
        } else {
            // Handle files without front matter
            $metadata = [];
            $htmlContent = $result;
        }

        if (!empty($metadata['date'])) {
            // Parse and format the date using Carbon
            $metadata['formatted_date'] = Carbon::createFromTimestamp($metadata['date'])->format('d-m-Y');
        }

        if (!empty($metadata['video'])) {
            $metadata['video_embed'] = $this->getOEmbedHtml($metadata['video']);
        }

        $imageFolderPath = $metadata['images'] ?? null;

        return [
            'metadata' => $metadata,
            'content' => $htmlContent,
            'images' => $imageFolderPath,
        ];
    }

    public function listRecipes()
    {
        $directory = resource_path('markdown/recipes');
        $recipeFiles = File::files($directory);
    
        $recipes = [];

        foreach ($recipeFiles as $file) {
            if (Str::endsWith($file->getFilename(), '.md')) {
                $filename = $file->getFilename(); // Get the full file path
                $recipeData = $this->parseRecipe($filename);
                $metadata = $recipeData['metadata'] ?? [];
                $metadata['slug'] = Str::slug($metadata['title']); // Create a slug for URL
                $recipes[] = $metadata;
            }
        }

        return $recipes;
    }

    protected function getOEmbedHtml($url) 
    {
        // Use an oEmbed library or make an API request to get the embed HTML
        // This is a simplified example using file_get_contents and the oembed API for YouTube
        // It's better to use a HTTP client like Guzzle in a real application
        $oembedEndpoint = 'https://www.youtube.com/oembed?url=' . urlencode($url) . '&format=json';
        try {
            $json = file_get_contents($oembedEndpoint);
            $data = json_decode($json, true);
            $html = $data['html'] ?? '';

            // Remove width and height attributes
            $html = preg_replace('/(width|height)="[^"]*"/i', '', $html);

            return $html;
        } catch (\Exception $e) {
            // Handle exceptions, such as network errors
            return '';
        }
    }
}