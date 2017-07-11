<?php
global $wpdb;
$wpdb->query( "DROP table Poems" );
delete_option('sb_paginate_count');