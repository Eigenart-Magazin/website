<script>
function toggleSearch() {
    var searchModal = document.querySelector('#search-modal');
    searchModal.style.display = searchModal.style.display === 'none' ? 'initial' : 'none';
}
</script>
<div class="search-modal" id="search-modal" style="display: none;">
  <a class="search-modal__logo" href="<?php echo get_site_url(); ?>">
    <img
      src="<?php echo get_theme_file_uri('/assets/images/logo.png'); ?>"
      alt="<?php bloginfo('name'); ?>"
    />
  </a>
  <form action="<?php echo get_site_url(); ?>" class="search">
    <div class="search__input-wrapper">
      <input class="search__input" type="text" name="s" placeholder="suchen..." autofocus>
      <button class="search__button">
        <img
          src="<?php echo get_theme_file_uri('/assets/images/search-icon-black.png'); ?>"
          alt="Search button"
        />
      </button>
    </div>
  </form>

  <button class="search__toggle-button" onclick="toggleSearch(this)">
    <img
      src="<?php echo get_theme_file_uri('/assets/images/cross-icon.png'); ?>"
      alt="Close Menu"
    />
  </button>
</div>
