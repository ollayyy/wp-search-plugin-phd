/*
You can now display the form on your site using a shortcode. Add the following to the university-emblem-search.php file:
    */

    // Shortcode to display the search form

    
function display_emblem_search_form() {
    ob_start();
    ?>
    <form id="university-search-form">
      <input type="text" id="university-name" placeholder="Enter university name" required />
      <button type="submit">Search Emblem</button>
    </form>
    <div id="emblem-results"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('university_emblem_search', 'display_emblem_search_form');
