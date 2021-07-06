<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;

use TononT\Webentwicklung\AuthenticationRequiredException;
use TononT\Webentwicklung\ForbiddenException;
use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\mvc\model\BlogPosts;
use TononT\Webentwicklung\mvc\model\Comments;
use TononT\Webentwicklung\mvc\model\User;
use TononT\Webentwicklung\mvc\view\Blog\Show as ShowView;
use TononT\Webentwicklung\mvc\view\Blog\Add as AddView;
use TononT\Webentwicklung\mvc\view\Blog\Info as InfoView;
use TononT\Webentwicklung\mvc\view\Blog\Impressum as ImpressumView;
use TononT\Webentwicklung\mvc\view\Blog\PopularPost as PopularView;
use TononT\Webentwicklung\mvc\view\Blog\Feed as FeedView;
use TononT\Webentwicklung\mvc\view\Blog\Home as HomeView;
use TononT\Webentwicklung\mvc\view\Blog\Comments as CommentsView;
use TononT\Webentwicklung\mvc\view\Auth\Delete as DeleteView;
use TononT\Webentwicklung\mvc\view\Blog\CommentDelete as DeleteCommentView;
use TononT\Webentwicklung\NotFoundException;
use TononT\Webentwicklung\Repository\BlogPostsRepository;
use Respect\Validation\Validator;
use TononT\Webentwicklung\mvc\controller\RssFeed as RSS;
use TononT\Webentwicklung\Repository\CommentsRepository;
use TononT\Webentwicklung\Repository\GetImage;
use TononT\Webentwicklung\Repository\UserRepository;

/**
 * Class Blog
 * @package TononT\Webentwicklung\controller
 */

class Blog extends AbstractController
{
    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function home(IRequest $request, IResponse $response): void
    {
        $view = new HomeView();
        $response->setBody($view->render([]));
    }
    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function info(IRequest $request, IResponse $response): void
    {
        $view = new InfoView();
        $response->setBody($view->render([]));
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     */

    public function impressum(IRequest $request, IResponse $response): void
    {
        $view = new ImpressumView();
        $response->setBody($view->render([]));
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     * @throws AuthenticationRequiredException
     */
    public function add(IRequest $request, IResponse $response): void
    {
        if (!$this->getSession()->isLoggedIn() && !$this->getSession()->isLoggedInAsAdmin()) {
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

            // create a database entry
            $blogPost = new BlogPosts();
            $blogPost->setTitle($request->getParameter('title'));
            $blogPost->setUrlKey($request->getParameter('urlKey'));
            $blogPost->setAuthor($request->getParameter('author'));
            $blogPost->setText($request->getParameter('text'));
            $blogPost->setFile($request->getFile());
            $repository = new BlogPostsRepository();
            $repository->add($blogPost);
            $response->setBody('great success');
            if ($response->getBody() == "great success") {
                $response->redirect("https://tonon.test/blog/show", 303);
            }
        }
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     * @throws AuthenticationRequiredException
     */
    public function updatePost(IRequest $request, IResponse $response): void
    {
        if (!$this->getSession()->isLoggedIn()) {
            throw new AuthenticationRequiredException();
        }
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     * @throws AuthenticationRequiredException
     * @throws NotFoundException
     */
    public function delete(IRequest $request, IResponse $response): void
    {
        if (!$this->getSession()->isLoggedInAsAdmin()) {
            $response->setBody("Only Admins");
            $response->redirect("https://tonon.test/home",303);
            throw new ForbiddenException();

        } else {
            $repository = new BlogPostsRepository();

            $lastSlash = strripos($request->getUrl(), '/') ?: 0;
            $potentialUrlKey = substr($request->getUrl(), $lastSlash + 1);
            $deleteUrlKey = substr($request->getUrl(), $lastSlash + 2);
            $entry = $repository->getByUrlKey($potentialUrlKey);

            if (!$entry && !$deleteUrlKey == "/blog/delete") {
                throw new NotFoundException();
            } else {

                //TODO ONLY IF ADMIN
                $view = new DeleteView();
                $repository->delete($potentialUrlKey);
                $response->setBody($view->render(['entry' => $entry]));
                }
            }
            }





    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function popular(IRequest $request, IResponse $response): void
    {
        $view = new PopularView();
        $repository = new BlogPostsRepository();
        $repository->getAllFiles();
        $image = new GetImage();
        $entry = $image->getImage();
        //$object = json_decode(json_encode($entry));
        // THIS IS THE BARE MINIMUM HERE! Better go for a serializer oder escaping library
        foreach ($entry as $key => $item) {
            $entry->$key = htmlspecialchars($item);
        }
        $response->setBody($view->render(['entry' => $entry]));
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function feed(IRequest $request, IResponse $response): void
    {

        $feedlist = new RSS();

        $feed1 =  "http://www.outdoorphotographer.com/tips-techniques/sports-adventures/feed/";
        $feed2 =  "https://rss.dw.com/xml/rss-de-news";
        $feed3 =  "https://gescheitmedien.de/category/news/feed/";
        $feed4 = "https://odysee.com/$/rss/@reitschuster/366992bb1cbd36050936a7bbd70a5615e54f37e2";

        $feedArray = array(
            $feed1,
            $feed2,
            $feed3,
            $feed4,

        );

           $view = new FeedView();
            $i = 1 * rand(0, 3);
            $feed = $feedArray[$i];
            $feedlist = $feedlist->dom($feed);
            $response->setBody($view->render(['entry' => $feedlist]));
    }


    /**
     * @param IRequest $request
     * @param IResponse $response
     * @throws AuthenticationRequiredException
     */
    public function comment(IRequest $request, IResponse $response): void
    {
        if (!$this->getSession()->isLoggedIn()) {
            throw new AuthenticationRequiredException();
        }

        if (!$request->hasParameter('text')) {
            // render the form
            $view = new CommentsView();
            $response->setBody($view->render([]));
        } else {
            Validator::allOf(Validator::notEmpty(), Validator::stringType())->check($request->getParameters()['text']);
            $comment = new Comments();
            $comment->setText($request->getParameter('text'));
            $comment->setName($request->getParameter('name'));
            $repository = new CommentsRepository();
            $repository->addComment($comment);
            $response->setBody('great success');
            $response->redirect("https://tonon.test/blog/show/how-to-blog", 303);
        }
    }



        /**
         * @param IRequest $request
         * @param IResponse $response
         * @throws AuthenticationRequiredException
         * @throws NotFoundException
         */
    public function commentDelete(IRequest $request, IResponse $response): void
    {
        if (!$this->getSession()->isLoggedInAsAdmin()) {
            $response->setBody("Only Admins can delete");
            //$response->redirect("https://tonon.test/popular/post",303);
            throw new AuthenticationRequiredException();
        } else {
            $repository = new CommentsRepository();

            $lastSlash = strripos($request->getUrl(), '/') ?: 0;
            $potentialID = substr($request->getUrl(), $lastSlash + 1);
            //TODO select right id

            $view = new DeleteCommentView();
                    $repository->deleteComment($potentialID);
                    $response->setBody('great success');
                    $response->setBody($view->render([]));
                    //$response->redirect("https://tonon.test/popular/post", 303);
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

            //TODO connect with id of blogposts
        $commentsRepo = new CommentsRepository();
        $commentsRepo->getAllComments();
        if (!$entry) {
            $potential = substr($request->getUrl(), $lastSlash + 2);
            if ($potential = "blog/show/") {
                $response->redirect("https://tonon.test/home", 300);
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
