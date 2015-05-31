# kirbytag download
by Jannik Beyerstedt from Hamburg, Germany  
[jannikbeyerstedt.de](http://jannikbeyerstedt.de) | [Github](https://github.com/jbeyerstedt)  


## return a beautiful download link for specific/ first/ last file
This is an extension of kirbytext for the [kirby cms](getkirby.com), which adds an easy way to embed your self-hosted html5-video sources in a responsive layout. This means, you can use it responsive, or it´ll adapt to your layout anyway.  

I know that there are some other solutions out there, but I´m lazy, so this is the version for the lazy people.
  
This extension can handle mp4 (h.264), webm and HTTP-live-streaming sources as well as a poster. You can select, which versions you have.  
Another special feature is, that the videos are stored in a special folder to keen bug data in one place.

#### note:
This is only tested with kirby 2!


#### how to use
store this file in

	site/tags/

Now you have a new kitbytext extension for download-links.  
The syntax is quite simple:

	(download: $keyword type: $filetype ext: $extension text: $someLinkText)

First thing to replace is `$keyword`. You can choose from:

- "first": selects the first file
- "last":  selects the last file
- or you can type some filename

Next we want to specify which files are affected. This is done with replacing `$filetype`. You can choose from the kirby file selectors:

- "document"
- "code"
- "images"
- "videos"

To condense the selection further down, you can replace `$extension` and type a filename extension.

With the `text` attribute (replace `$someLinkText`) you can set a custom text which is displayed instead of the filename.

##### keep in mind:
Of course the pattern above is only an example and not working by copying it. If some placeholder (the things with `$` at the beginning) is not replaced, you have to delete the keyword infront of it too.

##### examples:

	(download: first type: document)
	(download: flyer.pdf text: our beautiful products)


## contribution
Feel free to fork this repository an make it better.  
Perhaps we can implement the viewport width feature in some way.