<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller\Rest;


use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\IRestAware;
use TononT\Webentwicklung\mvc\controller\AbstractController;
use TononT\Webentwicklung\mvc\view\JsonView;
use TononT\Webentwicklung\mvc\view\RssFeed as RSS;
use TononT\Webentwicklung\NotFoundException;
use TononT\Webentwicklung\Repository\BlogPostsRepository;

class BlogPosts extends AbstractController
{
    public function getFeed(IRestAware $request, IResponse $response): void
    {
        $feedlist = new RSS('http://www.outdoorphotographer.com/blog/feed/');
        $feedlist = $feedlist->display(2,"FeedList of Photos");
        // TODO: error handling needs to be different for webservices!
        if (!$feedlist) {
            throw new NotFoundException();
        }
        $view = new JsonView();
        $response->setBody($view->render($feedlist));

    }
    /**
     * @param IRestAware $request
     * @param IResponse $response
     * @throws NotFoundException
     */
    public function getByUrlKey(IRestAware $request, IResponse $response): void
    {
        $repository = new BlogPostsRepository();

        // get blog entry from database
        $entry = $repository->getByUrlKey(current($request->getIdentifiers()));

        // TODO: error handling needs to be different for webservices!
        if (!$entry) {
            throw new NotFoundException();
        }
        $view = new JsonView();
        $response->setBody($view->render($entry));
    }


}