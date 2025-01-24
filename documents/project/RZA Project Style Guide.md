# Code Style

Use the `redirect($url)` function from the `include/utils.php` module. **DO NOT** use `header()`. This is to mitigate a problem where relative paths cause problems with the web server redirecting the user.

Please use the `<?=$var?>` syntax rather than using `<?php echo $var ?>` when interpolating PHP variables into HTML content. Make sure that the variable actually exist before doing this as well.

# Important Files

There are three different files you will have to include for each page that you create:

- `utils.php`
- `base.php` (includes `header.php`)
- `footer.php`

# Page Naming

You need to add a constant for the `<title>` element as follows:

```php
const PAGE_TITLE = "Example Template";
```

If you include `base.php` without doing this, it will lead to errors about undefined constants.

# Format

Your `.php` files (for when we start writing back-end code) should look like this:

```php
<?php

// This connects to the database and starts a session.
// It also provides several utility functions that wrap common functionality
// so it can be used across different pages.
require_once "include/utils.php";

// This will decide the name of the <title> element in `base.php` (name assigned to the tab).
const PAGE_TITLE = "Example Template";
include_once "include/base.php";

?>

<!-- Place your HTML here -->
<h1><?=PAGE_TITLE?></h1>
<p>This is an example template for what PHP pages/scripts should be formatted like.</p>
<p>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus nobis ipsam fugit a repellat natus id ea,
aliquam tempora voluptatem temporibus esse?
Aut id ipsam nemo quisquam quidem deserunt eligendi.
</p>
<button>Lorem ipsum dolor sit amet consectetur adipisicing elit.</button>

<!-- Don't forget to include the footer at the end so the closing tags can work with the remaining base content -->
<?php include_once "include/footer.php";
```

See `src/example_template.php` for a template.

You need to write your processing logic before the `PAGE_TITLE` and `base.php` are declared, but after the `utils.php` script. This will ensure that the application functions correctly.