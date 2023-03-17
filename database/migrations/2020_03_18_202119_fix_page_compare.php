<?php

use App\Models\Page\Page;
use Illuminate\Database\Migrations\Migration;
use App\Enums\PageAlias;

class FixPageCompare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Page::whereAlias(PageAlias::PAGE_COMPARE)->update(['only_auth' => 0]);
        Page::whereAlias(PageAlias::PAGE_COMPARE_CART)->update(['only_auth' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Page::whereAlias(PageAlias::PAGE_COMPARE)->update(['only_auth' => 1]);
        Page::whereAlias(PageAlias::PAGE_COMPARE_CART)->update(['only_auth' => 1]);
    }
}
