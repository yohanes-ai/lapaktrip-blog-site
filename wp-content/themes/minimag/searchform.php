<?php $searchpid = rand(0,999); ?>
<div class="header-search">
	<form method="get" id="<?php echo esc_attr($searchpid); ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="input-group">
			<input type="text" name="s" id="s-<?php echo esc_attr($searchpid); ?>" placeholder="<?php esc_html_e('Search...',"minimag"); ?>" class="form-control" required>
			<span class="input-group-btn">
				<button class="btn btn-secondary" type="submit"><i class="pe-7s-search"></i></button>
			</span>
		</div><!-- /input-group -->
	</form>
</div>

<?php $search_page = rand(0,999); ?>
<div class="pages-search">
	<form method="get" id="<?php echo esc_attr($search_page); ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="input-group">
			<input type="text" name="s" id="s-<?php echo esc_attr($search_page); ?>" placeholder="<?php esc_html_e('Search...',"minimag"); ?>" class="form-control" required>
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
			</span>
		</div><!-- /input-group -->
	</form>
</div>