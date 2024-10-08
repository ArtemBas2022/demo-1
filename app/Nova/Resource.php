<?php

namespace App\Nova;

use App\Services\SitemapService;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Scout\Builder  $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }

    public static function editorOptions($height = '980') {

        return [
            'content_css' => '/css/editor.css',
            'content_css_dark' => '/css/editor.css',
            'height' => $height,
            'plugins' => [
                'lists',
                'preview',
                'anchor',
                'pagebreak',
                'link',
                'image',
                'wordcount',
                'fullscreen',
                'directionality',
                'code'
            ],
            'image_class_list' => [
                ['title' => 'Wide', 'value' => 'is-wide'],
                ['title' => 'Left', 'value' => 'is-float-left'],
                ['title' => 'Right', 'value' => 'is-float-right'],
            ],
            'toolbar' => 'undo redo | styles | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | image | bullist numlist outdent indent | link | code',
            'use_lfm' => TRUE,
            'paste_as_text'=> TRUE,
            'language' => 'ru',
            'language_url' => '/vendor/tinymce/langs/ru.js',
        ];
    }
    /**
     * Determine if the current user can create new resources.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected static function refreshSitemap()
    :void {

        $sitemapService = app(SitemapService::class);
        $sitemapService->refreshSitemap();
    }

    /**
     * Determine if the current user can create new resources.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected static function addGenerateSitemap()
    :void {

        $sitemapService = app(SitemapService::class);
        $sitemapService->addGenerate();
    }
}
