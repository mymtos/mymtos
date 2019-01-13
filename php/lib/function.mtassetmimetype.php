<?php
# Copyright (C) 2001-2013 Six Apart, Ltd.
# This program is distributed under the terms of the
# GNU General Public License, version 2.
#
# $Id$

function smarty_function_mtassetmimetype($args, &$ctx)
{
    $asset = $ctx->stash('asset');
    if (!$asset) {
        return '';
    }

    return $asset->asset_mime_type;
}
