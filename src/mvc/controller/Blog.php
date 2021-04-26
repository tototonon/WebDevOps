<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;

use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\mvc\view\Blog\Show;

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
        $blogEntryFixture1         = new \stdClass();
        $blogEntryFixture1->title  = 'How to blog';
        $blogEntryFixture1->author = 'Ernie';
        $blogEntryFixture1->text   = 'Lorem ipsum dolor sit amet, anim id est laborum.';

        $blogEntryFixture2         = new \stdClass();
        $blogEntryFixture2->title  = 'MVC made easy';
        $blogEntryFixture2->author = 'Bert';
        $blogEntryFixture2->text   = 'Pulvinar fames non phasellus dignissim imperdiet sociosqu magna dictum gravida.';

        $view = new Show();

        $response->setBody($view->render(['entry' => $blogEntryFixture1]));

        if (preg_match('/\/mvc(\?|$)/', $request->getUrl()) === 1) {
            $response->setBody($view->render(['entry' => $blogEntryFixture2]));
        }
    }//end show()
}//end class
