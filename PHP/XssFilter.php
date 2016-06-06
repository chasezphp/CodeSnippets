<?php
/**
 * Prevent XSS.
 * Allowing you to add permmited tags or attributes.
 *
 * @author liuxd
 */

class XssFilter
{
    /**
     * Set white list.
     * @param array $p_aTags The tags you need.
     * @param array $p_aAttr The attributes you need.
     */
    public function __construct($p_aTags, $p_aAttr)
    {
        $this->aTags = $p_aTags;
        $this->aAttr = $p_aAttr;
    }
    /**
     * Process the String.
     * @param string $p_sInput
     * @return string
     */
    public function process($p_sInput)
    {
        list ($bReturn, $sInput) = $this->filter($p_sInput);
        if (!$bReturn) {
            $sInput = $this->process($sInput);
        }
        return $sInput;
    }
    /**
     * Filter.
     * @param string $p_sInput
     * @return array
     */
    private function filter($p_sInput)
    {
        $aMatches = [];
        $sPattern = '/<([a-zA-Z0-9]+).*?>.*?<\/\1>/';
        preg_match_all($sPattern, $p_sInput, $aMatches);
        $sInput = $p_sInput;
        $bReturn = true;
        if (!empty($aMatches[1])) {
            list ($aContents, $aTags) = $aMatches;
            foreach ($aTags as $iKey => $sTag) {
                if (!in_array($sTag, $this->aTags)) {
                    $bReturn = false;
                    $sInput = str_replace($aContents[$iKey], '', $sInput);
                } else {
                    $aTag = [];
                    preg_match('/<' . $sTag . '.*?>/', $aContents[$iKey], $aTag);
                    $aAttr = explode(' ', $aTag[0]);
                    if (!$this->checkAttr($aAttr)) {
                        $bReturn = false;
                        $sInput = str_replace($aContents[$iKey], '', $sInput);
                    }
                }
            }
        }
        return [$bReturn, trim($sInput)];
    }
    /**
     * Check tags' attributes.
     * @param array $p_aAttr
     * @return bool
     */
    private function checkAttr($p_aAttr)
    {
        $bResult = true;
        foreach ($p_aAttr as $sAttr) {
            $sAttrName = strstr($sAttr, '=', true);
            if ($sAttrName === false) {
                continue;
            }
            if (!in_array($sAttrName, $this->aAttr)) {
                $bResult = false;
            }
        }
        return $bResult;
    }
}

$str1 = '<h1>dear</h1><span>Hello</span><div class="no">world</div><div id="ha">My name is</div>liuxd';
$str2 = '<h3<h1>dear</h1>></<span>Hello</span>h3><div class="no">world</div><div id="ha">My name is</div>liuxd';
$obj = new XssFilter(['div'], ['id']);
$r1 = $obj->process($str1);
$r2 = $obj->process($str2);

# end of this file