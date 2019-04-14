<?php
/*
 * kirby 3 kirbytag - download
 * return a beautiful download link for all/ specific/ first/ last file
 *
 * copyright: Jannik Beyerstedt | http://jannikbeyerstedt.de | code@jannikbeyerstedt.de
 * license: http://www.gnu.org/licenses/gpl-3.0.txt GPLv3 License
 */

Kirby::plugin('jbeyerstedt/download', [
  'options' => [
    'class' => 'dl',
    'warnings' => 'true'
  ],
  'tags' => [
    'download' => [
      'attr' => [
        'text',
        'type',
        'ext'
      ],
      'html' => function($tag) {
        $types = array('image',
                       'document',
                       'archive',
                       'code',
                       'video',
                       'audio');

        $files = $tag->parent()->files();
        $class = option('jbeyerstedt.download.class');
        $warnings = option('jbeyerstedt.download.warnings');

        if ($tag->attr('type') != "") {
          if(in_array($tag->attrs['type'], $types)) {
            $files = $files->filterBy('type', $tag->attrs['type']);
          } else {
            return $warnings ? '<b>ERROR: download - no valid type defined</b>' : '';
          }
        }

        if ($tag->ext != "") {
          $files = $files->filterBy('extension', $tag->ext);
        }

        if (!$files || $files->count() == 0) {
          return $warnings ? '<b>WARNING</b>: no file(s) selected' : '';
        }

        if ($tag->value == 'first') {
          $files = $files->first();
        } else if ($tag->value == 'last') {
          $files = $files->last();
        } else if ($tag->value == 'all') {
          $files = $files;
        } else{
          $files = $files->find($tag->value);
        }

        if (!$files) {
          return $warnings ? '<b>WARNING</b>: file(s) could not be found.' : '';
        }

        if ($tag->value == 'all') {
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
        } else {
          // switch link text: filename or custom text
          $ext = $files->extension();
          $classes = $class . " " . $class . "--" . $ext; // i.e. "dl dl--pdf"
          (empty($tag->attrs['text'])) ? $text = $files->filename() : $text = $tag->attrs['text'];

          return '<a class="'. $classes .'" href="'.$files->url().'" data-ext="'. $ext .'" target="_blank" download>'.$text.'</a> <small>('.$files->niceSize().')</small>';
        }

      }
    ]
  ]
]);
