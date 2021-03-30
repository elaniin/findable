<?php

namespace Elaniin\Findable\Http\Controllers\Web;

use Illuminate\Routing\Controller;
use Statamic\Facades\Site;
use Elaniin\Findable\Concerns\AccessesSettings;
use Elaniin\Findable\Robots\Robots;

class RobotsTxtController extends Controller
{
    use AccessesSettings;

    /**
     * Render the robots.txt
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->getSettings('general', Site::current());
        $robots   = $settings->get('noindex_site')->value()
            ? Robots::getNoIndex()
            : Robots::getIndex();

        return response($robots)->header('Content-Type', 'text/plain');
    }
}
