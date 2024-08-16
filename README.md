# WooWire

An attempt to replace the WooCommerce theme templates with Blade and Livewire with a base Tailwind styling.

## What it intend to do

WooWire is intended to be used within Sage and Bedrock by Roots.

This package is meant as a boilerplate. run the `woowire:publish` command in the bedrock root to copy the files into your theme and then this package can be discarded. 

If that command don't copy any files try the `vendor:publish --tag=woowire` command instead and let me know.

know that these commands overwrites your files if you have any with the same name.

The templates use tailwind classes so, run your tailwind compiler and ythat should be fixed.

The package got livewire, some laravel, woocommerce and the sage-woocommerce bridge by generoi required if you dont already use them, but i recomend requiring all of them yourself.

## What it dont do

I don't intend to do anything to big affecting the checkout or how the backend works, it's just the single pages, archive pages and the mini cart

## What you should do

you can add the `@liveiwre('woo-wire-cart')` component somewhere in your navigation to get that thing going.
you should also probably remove the basic woocommerce styling with this filter
```
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
```

## Updates

if you want to overwrite the files you copied with the publish commands with a newer version you can use `woowire:update`