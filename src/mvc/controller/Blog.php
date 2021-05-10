<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\mvc\view\Blog\AbstractShow;
use TononT\Webentwicklung\mvc\view\Blog\ShowBlog;
use TononT\Webentwicklung\Repository\BlogPostsRepository;

/**
 * Class Blog
 * @package TononT\Webentwicklung\controller
 */

class Blog
{
    public function add(IRequest $request, IResponse $response): void
    {

    }

    /**
     * @param IRequest  $request
     * @param IResponse $response
     */
    public function show(IRequest $request, IResponse $response): void
    {
        /**
        $blogEntryFixture1 = new \stdClass();
        $blogEntryFixture1->title = 'How to blog';
        $blogEntryFixture1->author = 'Ernie';
        $blogEntryFixture1->text = 'Lorem ipsum dolor sit amet, anim id est laborum.';

        $blogEntryFixture2 = new \stdClass();
        $blogEntryFixture2->title = 'MVC made easy';
        $blogEntryFixture2->author = 'Bert';
        $blogEntryFixture2->text = 'Pulvinar fames non phasellus dignissim imperdiet sociosqu magna dictum gravida.';

        $view = new Show();

        $response->setBody($view->render(['entry' => $blogEntryFixture1]));

        if (preg_match('/\/mvc(\?|$)/', $request->getUrl()) === 1) {
            $response->setBody($view->render(['entry' => $blogEntryFixture2]));
        }

    }
         * */

        $repository = new BlogPostsRepository();
        $view = new AbstractShow();

        // extract URL key from call
        $lastSlash = strripos($request->getUrl(), '/') ?: 0;
        $potentialUrlKey = substr($request->getUrl(), $lastSlash + 1);

        // get blog entry from database
        try {
            $entry = $repository->getByUrlKey($potentialUrlKey);
            if($entry == null) {
                 $view = new ShowBlog();

            }
            // TODO here we would need error handling for our 404 handling
        } catch (\Exception $e) {
            $view = new ShowBlog();
            http_response_code($response->getStatusCode());
            echo $response->getBody();
        }
        $response->setBody($view->render(['entry' => $entry]));

    }//end show()
}//end class
