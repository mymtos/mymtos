<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtentrycommentcount($args, &$ctx)
{
    $entry = $ctx->stash('entry');
    $count = $entry->entry_comment_count;
    return $ctx->count_format($count, $args);
}
