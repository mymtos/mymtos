<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtentryauthordisplayname($args, &$ctx)
{
    // status: complete
    // parameters: none
    $entry = $ctx->stash('entry');
    if (!empty($entry)) {
        $author = $entry->author()->nickname;
        return $author;
    } else {
        return '';
    }
}
