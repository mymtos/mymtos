<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtauthorbasename($args, &$ctx)
{
    $author = $ctx->stash('author');
    if (!$author) {
        return '';
    }
    $basename = $author->author_basename;
    if ($sep = $args['separator']) {
        if ($sep == '-') {
            $basename = preg_replace('/_/', '-', $basename);
        } elseif ($sep == '_') {
            $basename = preg_replace('/-/', '_', $basename);
        }
    }
    return $basename;
}
