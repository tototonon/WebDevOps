<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;

use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\FilePost;
use TononT\Webentwicklung\mvc\view\Blog\Show as ShowView;
use TononT\Webentwicklung\mvc\view\Blog\Add as AddView;
use TononT\Webentwicklung\mvc\view\Blog\AddFile as AddFileView;
use TononT\Webentwicklung\NotFoundException;
use TononT\Webentwicklung\Repository\BlogPostsRepository;
use Respect\Validation\Validator;

/**
 * Class Blog
 * @package TononT\Webentwicklung\controller
 */

class Blog
{

    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function add(IRequest $request, IResponse $response): void
    {
        if($request->hasParameter('file')) {
            $view = new AddFileView();
            $response->setBody($view->render([]));
            Validator::allOf(Validator::notEmpty())->check($request->getParameters()['file']);
            $filePost = new FilePost();
            $filePost->file = $request->getParameter('file');
            $repository = new BlogPostsRepository();
            $repository->addFile($filePost);
        }
        if (!$request->hasParameter('title')) {
            // render the form
            $view = new AddView();
            $response->setBody($view->render([]));

    } else {
            // do the validation here
            Validator::allOf(Validator::notEmpty(), Validator::stringType())->check($request->getParameters()['title']);
            Validator::allOf(
                Validator::notEmpty(),
                Validator::stringType()
            )->check($request->getParameters()['urlKey']);
            Validator::allOf(
                Validator::notEmpty(),
                Validator::stringType()
            )->check($request->getParameters()['author']);
            Validator::allOf(Validator::notEmpty(), Validator::stringType())->check($request->getParameters()['text']);


            // create a database entry
            $blogPost = new BlogPosts();
            $blogPost->title = $request->getParameter('title');
            $blogPost->urlKey = $request->getParameter('urlKey');
            $blogPost->author = $request->getParameter('author');
            $blogPost->text = $request->getParameter('text');
            $repository = new BlogPostsRepository();
                $repository->add($blogPost);
                $response->setBody('great success');

        }
    }



    /**
     * @param IRequest  $request
     * @param IResponse $response
     */
    public function show(IRequest $request, IResponse $response): void
    {

        $repository = new BlogPostsRepository();
        $view = new ShowView();

        // extract URL key from call
        $lastSlash = strripos($request->getUrl(), '/') ?: 0;
        $potentialUrlKey = substr($request->getUrl(), $lastSlash + 1);

        // get blog entry from database
            $entry = $repository->getByUrlKey($potentialUrlKey);
        if (!$entry) {
            header("Location: http://tonon.test");
            echo "go back to tonon.test";
            die();
        }
            // escaping the entry fields with htmlspecialchars
            // THIS IS THE BARE MINIMUM HERE! Better go for a serializer oder escaping library
        foreach ($entry as $key => $item) {
            $entry->$key = htmlspecialchars($item);
        }


        $response->setBody($view->render(['entry' => $entry]));
    }//end show()
}//end class
