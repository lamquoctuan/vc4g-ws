<?php
global $post;
the_title('<h2>','</h2><hr/>',true);
echo '<p class="small">By ' . get_field('author_meta') . ' Posted ' . get_the_date('F d, Y') . '</p>';
echo '<p><img src="' . get_field('blog_image') . '" alt="' . get_the_title() . '" /></p>';
?>
<?php
$content = $post->post_content;
if (empty($content)) :
    get_template_part('template/blog', 'content');
else :
    echo $content;
endif;