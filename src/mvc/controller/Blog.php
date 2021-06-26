<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


use A\B;
use TononT\Webentwicklung\AuthenticationRequiredException;
use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\view\Blog\Show as ShowView;
use TononT\Webentwicklung\mvc\view\Blog\Add as AddView;
use TononT\Webentwicklung\mvc\view\Blog\Search as SearchView;
use TononT\Webentwicklung\mvc\view\Blog\Home as HomeView;
use TononT\Webentwicklung\NotFoundException;
use TononT\Webentwicklung\Repository\BlogPostsRepository;
use Respect\Validation\Validator;
use TononT\Webentwicklung\mvc\controller\RssFeed as RSS;

/**
 * Class Blog
 * @package TononT\Webentwicklung\controller
 */

class Blog extends AbstractController
{

    /**
     * @param IRequest $request
     * @param IResponse $response
     * @throws AuthenticationRequiredException
     */
    public function add(IRequest $request, IResponse $response): void
    {
        if (!$this->getSession()->isLoggedIn()) {
            throw new AuthenticationRequiredException();
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
            //Validator::allOf(Validator::notEmpty(), Validator::stringType())->check($request->getParameters()['file']);

            // create a database entry
            $blogPost = new BlogPosts();
            $blogPost->setTitle( $request->getParameter('title'));
            $blogPost->setUrlKey($request->getParameter('urlKey'));
            $blogPost->setAuthor($request->getParameter('author'));
            $blogPost->setText($request->getParameter('text'));
            $blogPost->setFile($request->getFile());
            $repository = new BlogPostsRepository();
                $repository->add($blogPost);
                $response->setBody('great success');
        }
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function home(IRequest $request, IResponse $response): void
    {
        $view = new HomeView();
        $feedlist = new RSS();

        if($feedlist != null) {
            $feedlist = $feedlist->dom();

            //$object = json_decode(json_encode($feedlist));

        } else {
            throw new NotFoundException();
        }

        //$response->setBody($view->xmlRender($feedlist));
        $response->setBody($view->render(['entry' => $feedlist]));


    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function search(IRequest $request, IResponse $response): void
    {
        $repository = new BlogPostsRepository();
        $view = new SearchView();
        // extract URL key from call
        $lastSlash = strripos($request->getUrl(), '/') ?: 0;
        $potentialUrlKey = substr($request->getUrl(), $lastSlash + 1);
        $entry = $repository->getAllFiles();

        $object = json_decode(json_encode($entry));

        // THIS IS THE BARE MINIMUM HERE! Better go for a serializer oder escaping library
        foreach ($object as $key => $item) {
            $object->$key = htmlspecialchars($item);
        }
        $response->setBody($view->render(['entry' => $object]));



    }
    public function delete(IRequest $request, IResponse $response): void
    {
        if(!$this->getSession()->isLoggedIn()) {

            throw new AuthenticationRequiredException();

        } else {
            $repository = new BlogPostsRepository();
        }
            $lastSlash = strripos($request->getUrl(), '/') ?: 0;
            $potentialUrlKey = substr($request->getUrl(), $lastSlash + 1);
            $entry = $repository->getByUrlKey($potentialUrlKey);

            if (!$entry) {

                throw new NotFoundException();

                } else {
                    $repository->delete($potentialUrlKey);
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
            $potential= substr($request->getUrl(), $lastSlash + 2);
            if($potential = "blog/show/") {
                $entry = $repository->getAllFiles();
                $view = new HomeView();
            } else {
                throw new NotFoundException();

            }
        }
            // escaping the entry fields with htmlspecialchars
            // THIS IS THE BARE MINIMUM HERE! Better go for a serializer oder escaping library
        foreach ($entry as $key => $item) {
            $entry->$key = htmlspecialchars($item);
        }

        $response->setBody($view->render(['entry' => $entry]));
    }//end show()
}//end class
