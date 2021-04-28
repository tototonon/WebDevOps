<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;

use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\mvc\view\Blog\Show;
use TononT\Webentwicklung\Repository\BlogPostsRepository;

/**
 * Class Blog
 * @package TononT\Webentwicklung\controller
 */

class Blog
{

    /**
     * @param IRequest  $request
     * @param IResponse $response
     */
    public function show(IRequest $request, IResponse $response): void
    {
        $repository = new BlogPostsRepository();
        $view = new Show();

        // extract URL key from call
        $lastSlash = strripos($request->getUrl(), '/') ?: 0;
        $potentialUrlKey = substr($request->getUrl(), $lastSlash + 1);

        // get blog entry from database
        $entry = $repository->getByUrlKey($potentialUrlKey);
        // TODO here we would need error handling for our 404 handling
        $response->setBody($view->render(['entry' => $entry]));

    }//end show()
}//end class
