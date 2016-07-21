<?php
/**
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 Template Name: Contributors
 */

get_header(); ?>

		<div class="contributors-page content-container">
                <?php include('xml-parse.php'); ?>

				<div class="page-title-container"><?php get_search_form( $echo ); ?><h1 class="page-title">Meet the Authors</h1></div>
                <div class="hub">
                <?php list_all_authors(); ?>
                </div>
		</div> <!-- .content-container -->		
        