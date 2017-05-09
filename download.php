<?php
// -------------------------------------------
// kirby tag
// Title:  download
// function: return a beautiful download link for all/ specific/ first/ last file

// copyright: Jannik Beyerstedt | http://jannikbeyerstedt.de | code@jannikbeyerstedt.de
// license: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License

// usage:
// (download: $keyword type: $filetype ext: $extension text: $someLinkText)
// $keyword:   type "all" for all files in collection, "first" or "last" for first/ last of collection, or specify the filename
// $filetype:  filetype to choose: document/ code/ images/ videos
// $extension: filename extension to filter

// version: 1.1.0 (27.03.2016)
// changelog:
// -------------------------------------------


kirbytext::$tags['download'] = array( // give keyword "first" or "last" or the filename(with extension)
  'attr' => array(
    'text',
    'type',
    'ext'
  ),
  'html' => function($tag) {

    $types = array('image',
    'document',
    'archive',
    'code',
    'video',
    'audio');

    $files = $tag->page()->files();
    $class = c::get('tags.download.class', 'dl');
    $warnings = c::get('tags.download.warnings', true);

    if ($tag->attr('type') != "") {
      if(in_array($tag->attr('type'), $types)) {
        $files = $files->filterBy('type', $tag->attr('type'));
      }else {
        return $warnings ? '<b>ERROR: download - no valid type defined</b>' : '';
      }
    }

    if ($tag->attr('ext') != "") {
      $files = $files->filterBy('extension', $tag->attr('ext'));
    }

    if (!$files || $files->count() == 0) {
      return $warnings ? '<b>WARNING</b>: no file(s) selected' : '';
    }

    if ($tag->attr('download') == 'first') {
      $files = $files->first();
    }else if ($tag->attr('download') == 'last') {
      $files = $files->last();
    }else if ($tag->attr('download') == 'all') {
      $files = $files;
    }else{
      $files = $files->find($tag->attr('download'));
    }

    if (!$files) {
      return $warnings ? '<b>WARNING</b>: file(s) could not be found.' : '';
    }

    if ($tag->attr('download') == 'all') {
      $html = '<ul>';
      foreach ($files as $file) {
        $ext = $file->extension();
        $classes = $class . " " . $class . "--" . $ext; // i.e. "dl dl--pdf"
        $text = $file->filename();
        $html .= '<li>';
        $html .= '<a class="'. $classes .'" href="'.$file->url().'" data-ext="'. $ext .'" target="_blank" download>'.$text.'</a> <small>('.$file->niceSize().')</small>';
        $html .= '</li>';
      }

      $html .= '</ul>';
      return $html;
    } else{
      // switch link text: filename or custom text
      $ext = $files->extension();
      $classes = $class . " " . $class . "--" . $ext; // i.e. "dl dl--pdf"
      (empty($tag->attr('text'))) ? $text = $files->filename() : $text = $tag->attr('text');
      return '<a class="'. $classes .'" href="'.$files->url().'" data-ext="'. $ext .'" target="_blank" download>'.$text.'</a> <small>('.$files->niceSize().')</small>';
    }
  }
);
?>
