<?php
// -------------------------------------------
// kirby tag
// Title:  download
// function: return a beautiful download link for specific/ first/ last file

// copyright: Jannik Beyerstedt | http://jannikbeyerstedt.de | code@jannikbeyerstedt.de
// license: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License

// usage:
// (download: $keyword type: $filetype ext: $extension text: $someLinkText)
// $keyword:   type "first" or "last" for first/ last of collection, or specify the filename
// $filetype:  filetype to choose: document/ code/ images/ videos
// $extension: filename extension to filter

// version: 1.0.0 (28.04.2015)
// changelog: 
// -------------------------------------------


kirbytext::$tags['download'] = array( // give keyword "first" or "last" or the filename(with extension)
  'attr' => array(
    'text',
    'type',
    'ext'
  ),
  'html' => function($tag) {
    
    $types = array('document',
                   'code',
                   'images',
                   'videos');
    
    $files = $tag->page()->files();
    
    if ($tag->attr('type') != "") {
      if(in_array($tag->attr('type'), $types)) {
        $files = $files->filterBy('type', $tag->attr('type'));
      }else {
        return('<b>ERROR: download - no valid type defined</b>');
      }
    }
    
    if ($tag->attr('ext') != "") {
      $files = $files->filterBy('extension', $tag->attr('ext'));
    }
    
    if ($files->count() == 0) {
      return '<b>WARNING</b>: no files selected';
    }
    
    if ($tag->attr('download') == 'first') {
      $file = $files->first();
    }else if ($tag->attr('download') == 'last') {
      $file = $files->last();
    }else{
      $file = $files->find($tag->attr('download'));
    }
    
    // switch link text: filename or custom text
    (empty($tag->attr('text'))) ? $text = $file->filename() : $text = $tag->attr('text');
      
    return '<a class="dl" href="'.$file->url().'" target="_blank">'.$text.'</a> <small>('.$file->niceSize().')</small>';
  }
);
?>