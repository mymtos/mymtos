<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mthttpcontenttype($args, &$ctx)
{
    $ctx->stash('content_type', $args['type']);
    return '';
}
