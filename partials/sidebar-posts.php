<?php 

    $recent_posts = get_posts([
        'posts_per_page' => 3
    ]);

?>

<aside class="sidebar">
    <div class="sidebar__section sidebar__section--recent-posts">
        <h3 class="sidebar__heading">Recent posts</h3>
        <?php foreach ( $recent_posts as $post ) : ?>
            <article class="post post--intro post--intro--horizontal">
                <a href="<?php echo get_the_permalink( $post->ID ); ?>">
                    <?php echo get_the_post_thumbnail( $post->ID, 'post-intro-thumb', ['class' => 'post__thumbnail'] ); ?>
                    <h3 class="post__title"><?php echo get_the_title( $post->ID ); ?></h3>
                    <p class="post__date"><time><?php echo get_the_date( get_option( 'date_format' ), $post->ID ); ?></time></p>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="sidebar__section sidebar__section--archive">
        <h3 class="sidebar__heading">Archive</h3>
        <ul class="list list--archive">
            <?php wp_get_archives() ?>
        </ul>
    </div>
    <div class="sidebar__section sidebar__section--tags">
        <h3 class="sidebar__heading">Tags</h3>
        <ul class="list list--tags">
            <?php foreach ( get_tags() as $tag ) : ?>
                <li><a href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo $tag->name;  ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>