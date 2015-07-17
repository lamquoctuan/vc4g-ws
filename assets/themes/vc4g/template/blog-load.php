<?php
global $post;
the_title('<h2>','</h2><hr/>',true);
$content = $post->post_content;
if (empty($content)) :
    get_template_part('template/blog', 'content');
else :
    echo $content;
endif;