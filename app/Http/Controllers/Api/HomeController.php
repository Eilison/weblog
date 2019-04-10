<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use App\Repositories\VisitorRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends ApiController
{
    protected $user;
    protected $visitor;
    protected $article;
    protected $comment;

    public function __construct(
        UserRepository $user,
        VisitorRepository $visitor,
        ArticleRepository $article,
        CommentRepository $comment)
    {
        parent::__construct();

        $this->user = $user;
        $this->visitor = $visitor;
        $this->article = $article;
        $this->comment = $comment;
    }

    public function statistics()
    {
        $isAdmin = Auth::user()->is_admin;

        $data = array();
        if ($isAdmin) {
            $users = $this->user->getNumber();
            $visitors = (int) $this->visitor->getAllClicks();
            $articles = $this->article->getNumber();
            $comments = $this->comment->getNumber();

            $data = compact('users', 'visitors', 'articles', 'comments');
        }
        return $this->response->json($data);
    }

    public function menus() {
        $isAdmin = Auth::user()->is_admin;

        $baseMenus = array(
            array(
                "label"   => 'sidebar.dashboard',
                "icon"    => 'ion-ios-speedometer',
                "uri"     => '/dashboard/home'
            ),
            array(
                "label" => 'sidebar.article',
                "icon" => 'ion-ios-book',
                "uri" => '/dashboard/articles'
            ),
            array(
                "label" => 'sidebar.comment',
                "icon" => 'ion-chatbubble-working',
                "uri" => '/dashboard/comments'
            ),
            array(
                "label" => 'sidebar.tag',
                "icon" => 'ion-ios-pricetags',
                "uri" => '/dashboard/tags'
            ),
        );


        if ($isAdmin){
            $baseMenus = array_merge($baseMenus, array(

                array(
                    "label" => 'sidebar.user',
                    "icon" => 'ion-person-stalker',
                    "uri" => '/dashboard/users'
                ),
                array(
                    "label" => 'sidebar.discussion',
                    "icon" => 'ion-help-circled',
                    "uri" => '/dashboard/discussions'
                ),
                array(
                    "label" => 'sidebar.file',
                    "icon" => 'ion-ios-folder',
                    "uri" => '/dashboard/files'
                ),
                array(
                    "label" => 'sidebar.category',
                    "icon" => 'ion-ios-list',
                    "uri" => '/dashboard/categories'
                ),
                array(
                    "label" => 'sidebar.link',
                    "icon" => 'ion-ios-world',
                    "uri" => '/dashboard/links'
                ),
                array(
                    "label" => 'sidebar.visitor',
                    "icon" => 'ion-chatbubble-working',
                    "uri" => '/dashboard/visitors'
                ),
                array(
                    "label" => 'sidebar.system',
                    "icon" => 'ion-gear-b',
                    "uri" => '/dashboard/system'
                )
            ));
        }

        return $this->response->json($baseMenus);
    }

}
