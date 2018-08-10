<?php

class myPagination extends Pagination{
    public static function create($count, $per_page = 10){
        $config = array(
          'total_items'        => $count,
          'per_page'           => $per_page,
          'uri_segment'        => 'page',
          'num_links'          => 10,
          'wrapper'            => '<ul class="pagenation clearfix">{pagination}</ul>',
          'first'              => '<li class="first">{link}</li>',
          'regular'            => '<li>{link}</li>',
          'active'             => '<li class="active"><span>{link}</span></li>',
          'active-link'        => '{page}',
          'previous'           => '<li class="prev">{link}</li>',
          'previous-inactive'  => '<li class="prev disabled">{link}</li>',
          'next'               => '<li class="next">{link}</li>',
          'next-inactive'      => '<li class="next disabled">{link}</li>',
          'next-marker'        => '&gt;&gt;',
          'previous-marker'    => '&lt;&lt;',
		  'wrapper'        => '<ul class="pagination">{pagination}</ul>',
        );
        return parent::forge("mypagination",$config);
    }
}
