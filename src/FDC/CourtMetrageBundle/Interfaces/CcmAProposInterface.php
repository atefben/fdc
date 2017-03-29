<?php

namespace FDC\CourtMetrageBundle\Interfaces;

interface CcmAProposInterface
{
    const VIDEO = 'video';
    const YOUTUBE = 'youtube';
    const IMAGE = 'image';
     
    public static function getAProposTypes();
}