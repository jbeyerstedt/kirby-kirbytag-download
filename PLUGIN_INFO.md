This kirbytag returns a beatiful download-link for a specific file in your site's content. It generates a link with a customizable text and dispays the filesize.

That's nothing special, but come some features for lazy people:  
You can choose your file, by the file categorization kirby uses (document, image, etc.) and the select by first or last. If you have a file, like a regularly updating flyer, you can keep going on with individual file names, but don't have to specify the name in the tag eveny time you change your file! Isn't this awesome?

## User Manual

#### Installation
store this file in

	site/tags/

#### Usage
Now you have a new kitbytext extension for download-links.  
The syntax is quite simple:

	(download: $keyword type: $filetype ext: $extension text: $someLinkText)

First thing to replace is `$keyword`. You can choose from:

- "first": selects the first file
- "last":  selects the last file
- "all": selects all files (of given type)
- or you can type some filename

Next we want to specify which files are affected. This is done with replacing `$filetype`. You can choose from the kirby file selectors:

- "image"
- "document"
- "archive"
- "code"
- "video"
- "audio"

To condense the selection further down, you can replace `$extension` and type a filename extension.

With the `text` attribute (replace `$someLinkText`) you can set a custom text which is displayed instead of the filename.

##### keep in mind:
Of course the pattern above is only an example and not working by copying it. If some placeholder (the things with `$` at the beginning) is not replaced, you have to delete the keyword infront of it too.

##### examples:

	(download: first type: document)
	(download: flyer.pdf text: our beautiful products)


## Contribution
Feel free to fork this repository and make it better.
