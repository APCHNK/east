<?php
$songs_title = get_sub_field('title');
$cards = get_sub_field('cards');
$vinyl_image = get_sub_field('vinyl_image');
$vinyl_label = get_sub_field('vinyl_label_text');
$vinyl_ribbon = get_sub_field('vinyl_ribbon_text');

if (!$cards || !is_array($cards) || count($cards) === 0) return;

if (empty($vinyl_label))  $vinyl_label  = 'EAST 17';
if (empty($vinyl_ribbon)) $vinyl_ribbon = 'EAST 17 ❖ ';

// Build a long-enough ribbon string by repeating until it covers the circle.
$ribbon = str_repeat( $vinyl_ribbon, max( 4, ceil( 180 / max( 1, mb_strlen( $vinyl_ribbon ) ) ) ) );
?>
<div class="songs-section">
  <?php if ($songs_title) : ?>
    <h2 class="reveal reveal--up"><?php echo esc_html($songs_title); ?></h2>
  <?php endif; ?>
  <div class="songs-grid">
    <?php foreach ($cards as $index => $card) :
      $image = $card['image'] ?? null;
      $title = $card['title'] ?? '';
      $desc = $card['description'] ?? '';
      $url = $card['url'] ?? '#';
    ?>
      <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="songs-card reveal reveal--up" data-reveal-delay="<?php echo ($index * 80); ?>">
        <?php if ($image) : ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
        <?php endif; ?>
        <div class="songs-card__overlay">
          <?php if ($title) : ?>
            <h3><?php echo esc_html($title); ?></h3>
          <?php endif; ?>
          <?php if ($desc) : ?>
            <p><?php echo wp_kses_post($desc); ?></p>
          <?php endif; ?>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

  <div class="songs-vinyl reveal reveal--up" aria-hidden="true">
    <div class="songs-vinyl__disc songs-vinyl__disc--text">
      <svg class="songs-vinyl__ribbon" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <path id="e17-circle" d="M 100,100 m -84,0 a 84,84 0 1,1 168,0 a 84,84 0 1,1 -168,0" fill="none" />
        </defs>
        <text font-family="Instrument Sans, Manrope, Arial, sans-serif" font-weight="800" font-size="11" letter-spacing="3" fill="#ededed">
          <textPath href="#e17-circle" startOffset="0"><?php echo esc_html( $ribbon ); ?></textPath>
        </text>
      </svg>

      <?php if ( ! empty( $vinyl_image['url'] ) ) : ?>
        <span class="songs-vinyl__label songs-vinyl__label--photo">
          <img src="<?php echo esc_url( $vinyl_image['url'] ); ?>" alt="<?php echo esc_attr( $vinyl_image['alt'] ?? '' ); ?>" loading="lazy">
        </span>
      <?php else : ?>
        <span class="songs-vinyl__label"><?php echo esc_html( $vinyl_label ); ?></span>
      <?php endif; ?>
    </div>
  </div>
</div>
