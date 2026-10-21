<?php

namespace App\Composers;

// use App\Models\GovernmentLinks;
use Illuminate\View\View;

class FooterComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $links;

    // /**
    //  * Create a new profile composer.
    //  *
    //  * @param  \App\Repositories\UserRepository  $users
    //  * @return void
    //  */
    // public function __construct(GovernmentLinks $links)
    // {
    //     $this->links = $links->all();
    // }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('links', $this->links);
    }
}
