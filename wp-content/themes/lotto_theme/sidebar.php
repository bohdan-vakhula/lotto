<div id="sidebar">
	<ul>
		<?php
			$sidebar = get_post_meta(get_the_id(), '_custom_sidebar', 1);
			if (!$sidebar) {
				$sidebar = 'Default Sidebar';
			}
			dynamic_sidebar($sidebar);
		?>
	</ul>
</div>