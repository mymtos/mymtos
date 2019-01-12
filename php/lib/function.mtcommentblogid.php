<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtcommentblogid($args, &$ctx)
{
    $comment = $ctx->stash('comment');
    return (isset($args['pad']) && $args['pad']) ? sprintf("%06d", $comment->comment_blog_id) : $comment->comment_blog_id;
}
