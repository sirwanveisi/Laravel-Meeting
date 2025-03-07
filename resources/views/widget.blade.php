﻿<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
        content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0, user-scalable=no">

    <link href="{{ asset('css/widget.min.css') }}" rel="stylesheet">
</head>

<body>
    <section class="design-surface">
        <canvas id="temp-canvas"></canvas>
        <canvas id="main-canvas"></canvas>
    </section>

    <!-- toolbox -->

    <section id="tool-box" class="tool-box">
        <canvas id="pencil-icon" width="40" height="40" title="{{ __('Pencil') }}"></canvas>
        <canvas id="marker-icon" width="40" height="40" title="{{ __('Marker') }}"></canvas>

        <canvas id="eraser-icon" width="40" height="40" title="{{ __('Erase drawings') }}"></canvas>
        <canvas id="text-icon" width="40" height="40" title="{{ __('Write text') }}"></canvas>
        <canvas id="image-icon" width="40" height="40" title="{{ __('Add image') }}"></canvas>

        <canvas id="pdf-icon" width="40" height="40" title="{{ __('Add pdf') }}"></canvas>

        <canvas id="drag-last-path" width="40" height="40" title="{{ __('Drag/move last path') }}"></canvas>
        <canvas id="drag-all-paths" width="40" height="40" title="{{ __('Drag/move all paths') }}"></canvas>

        <canvas id="line" width="40" height="40" title="{{ __('Draw Lines') }}"></canvas>
        <canvas id="arrow" width="40" height="40" title="{{ __('Draw Arrows') }}"></canvas>

        <canvas id="zoom-up" width="40" height="40" title="{{ __('Zoon-In') }}"></canvas>
        <canvas id="zoom-down" width="40" height="40" title="{{ __('Zoom-Out') }}"></canvas>

        <canvas id="arc" width="40" height="40" title="{{ __('Arc') }}"></canvas>
        <canvas id="rectangle" width="40" height="40" title="{{ __('Rectangle') }}"></canvas>
        <canvas id="quadratic-curve" width="40" height="40" title="{{ __('Quadratic curve') }}"></canvas>
        <canvas id="bezier-curve" width="40" height="40" title="{{ __('Bezier curve') }}"></canvas>

        <canvas id="undo" width="40" height="40" title="{{ __('Undo: Remove recent shapes') }}"></canvas>

        <canvas id="line-width" width="40" height="40" title="{{ __('Set line-width') }}"></canvas>
        <canvas id="colors" width="40" height="40" title="{{ __('Set foreground and background colors') }}"></canvas>
        <canvas id="additional" width="40" height="40" title="{{ __('Extra options') }}"></canvas>
        <canvas id="snap" width="40" height="40" title="{{ __('Take Snapshot') }}"></canvas>
        <canvas id="clear" width="40" height="40" title="{{ __('Clear') }}"></canvas>
    </section>

    <!-- pdf -->

    <section id="pdf-page-container">
        <img id="pdf-prev" />
        <select id="pdf-pages-list"></select>
        <img id="pdf-next" />
        <img id="pdf-close" />
    </section>

    <!-- arc -->

    <section id="arc-range-container" class="arc-range-container">
        <input id="arc-range" class="arc-range" type="text" value="2">
        <input type="checkbox" id="is-clockwise" checked="" class="allow-select">
        <label for="is-clockwise">Clockwise?</label>
        <div class="arc-range-container-guide">Use arrow keys ↑↓</div>
    </section>

    <!-- generated code -->

    <section class="code-container">
        <textarea id="code-text" class="code-text allow-select"></textarea>
    </section>

    <section class="preview-panel" style="display: none;">
        <div id="design-preview" class="preview-selected">Preview</div>
        <div id="code-preview">Code</div>
    </section>

    <!-- options -->

    <section id="options-container" class="options-container">
        <div>
            <input type="checkbox" id="is-absolute-points" checked="">
            <label for="is-absolute-points">Absolute Points</label>
        </div>
        <div>
            <input type="checkbox" id="is-shorten-code" checked="">
            <label for="is-shorten-code">Shorten Code</label>
        </div>
    </section>

    <!-- line-width -->

    <section id="line-width-container" class="context-popup">
        <label for="line-width-text">Line Width:</label>
        <input id="line-width-text" class="line-width-text" type="text" value="2">

        <div id="line-width-done" class="btn-007">Done</div>
    </section>

    <!-- colors selector -->

    <section id="colors-container" class="context-popup colors-container">
        <div class="input-div">
            <label for="stroke-style">{{ __('Stroke Style') }}:</label>
            <input id="stroke-style" type="color" value="#6c96c8">
        </div>

        <div class="input-div">
            <label for="fill-style">{{ __('Fill Style') }}:</label>
            <input id="fill-style" type="color" value="#ffffff">
        </div>

        <div id="colors-done" class="btn-007">{{ __('Done') }}</div>
    </section>

    <!-- marker selector -->

    <section id="marker-container" class="context-popup colors-container">

        <div class="input-div">
            <label for="marker-stroke-style">Thickness:</label>
            <select id="marker-stroke-style" value="8">
                <option value='8'>8</option>
                <option value='9'>9</option>
                <option value='10'>10</option>
                <option value='11'>11</option>
                <option value='12'>12</option>
                <option value='14'>14</option>
                <option value='16'>16</option>
                <option value='18'>18</option>
                <option value='20'>20</option>
                <option value='22'>22</option>
                <option value='22'>22</option>
                <option value='24'>24</option>
                <option value='26'>26</option>
                <option value='28'>28</option>
                <option value='36'>36</option>
                <option value='36'>36</option>
                <option value='48'>48</option>
                <option value='72'>72</option>
            </select>
        </div>
        <div class="input-div" id='marker-color-container'>
            <label for="marker-fill-style">Fill Color:</label>
            <div id="marker-selected-color"></div>
            <div id="marker-fill-colors" class='context-popup'>
                <div class="top">
                    <div id="marker-selected-color-2"></div>
                    <input id="marker-fill-style" type="text" value="FF7373">
                </div>
                <table id="marker-colors-list">

                </table>
            </div>
        </div>
        </div>

        <div id="marker-done" class="btn-007">Done</div>
    </section>

    <!-- marker selector -->

    <!-- pencil selector -->

    <section id="pencil-container" class="context-popup colors-container">

        <div class="input-div">
            <label for="pencil-stroke-style">Thickness:</label>
            <select id="pencil-stroke-style">
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5' selected>5</option>
                <option value='6'>6</option>
                <option value='7'>7</option>
                <option value='8'>8</option>
                <option value='9'>9</option>
                <option value='10'>10</option>
                <option value='11'>11</option>
                <option value='12'>12</option>
                <option value='14'>14</option>
                <option value='16'>16</option>
                <option value='18'>18</option>
                <option value='20'>20</option>
                <option value='22'>22</option>
                <option value='22'>22</option>
                <option value='24'>24</option>
                <option value='26'>26</option>
                <option value='28'>28</option>
                <option value='36'>36</option>
                <option value='36'>36</option>
                <option value='48'>48</option>
                <option value='72'>72</option>
            </select>
        </div>
        <div class="input-div" id='pencil-color-container'>
            <label for="pencil-fill-style">Fill Color:</label>
            <div id="pencil-selected-color"></div>
            <div id="pencil-fill-colors" class='context-popup'>
                <div class="top">
                    <div id="pencil-selected-color-2"></div>
                    <input id="pencil-fill-style" type="text" value="6699FF">
                </div>
                <table id="pencil-colors-list">

                </table>
            </div>
        </div>
        </div>

        <div id="pencil-done" class="btn-007">Done</div>
    </section>

    <!-- pencil selector -->

    <!-- copy paths -->

    <section id="copy-container" class="context-popup">
        <div>
            <input type="checkbox" id="copy-last" checked="" />
            <label for="copy-last">Copy last path</label>
        </div>
        <div style="margin-top: 5px;">
            <input type="checkbox" id="copy-all" />
            <label for="copy-all">Copy all paths</label>
        </div>
    </section>

    <!-- additional controls -->

    <section id="additional-container" class="context-popup additional-container">
        <div>
            <label for="lineCap-select">Line Cap:</label>
            <select id="lineCap-select">
                <option>round</option>
                <option>butt</option>
                <option>square</option>
            </select>
        </div>

        <div>
            <label for="lineJoin-select">Line Join:</label>
            <select id="lineJoin-select">
                <option>round</option>
                <option>bevel</option>
                <option>miter</option>
            </select>
        </div>

        <div>
            <label for="globalAlpha-select">globalAlpha:</label>
            <select id="globalAlpha-select">
                <option>1.0</option>
                <option>0.9</option>
                <option>0.8</option>
                <option>0.7</option>
                <option>0.6</option>
                <option>0.5</option>
                <option>0.4</option>
                <option>0.3</option>
                <option>0.2</option>
                <option>0.1</option>
                <option>0.0</option>
            </select>
        </div>

        <div>
            <label for="globalCompositeOperation-select">globalCompositeOperation:</label>
            <select id="globalCompositeOperation-select">
                <option>source-atop</option>
                <option>source-in</option>
                <option>source-out</option>
                <option selected="">source-over</option>
                <option>destination-atop</option>
                <option>destination-in</option>
                <option>destination-out</option>
                <option>destination-over</option>
                <option>lighter</option>
                <option>copy</option>
                <option>xor</option>
            </select>
        </div>

        <div id="additional-close" class="btn-007">Done</div>
    </section>

    <!-- fade -->

    <div id="fade"></div>

    <!-- text font/family/color -->

    <ul class="fontSelectUl" style="display: none; position: absolute; top: 0; left: 0; width: 166px;">
        <li>Arial</li>
        <li>Arial Black</li>
        <li>Comic Sans MS</li>
        <li>Courier New</li>
        <li>Georgia</li>
        <li>Tahoma</li>
        <li>Times New Roman</li>
        <li>Trebuchet MS</li>
        <li>Verdana</li>
    </ul>

    <ul class="fontSizeUl"
        style="display: none; position: absolute; top: 0; left: 0; width: 50px; text-align: center;">
        <li>15</li>
        <li>17</li>
        <li>19</li>
        <li>20</li>
        <li>22</li>
        <li>25</li>
        <li>30</li>
        <li>35</li>
        <li>42</li>
        <li>48</li>
        <li>60</li>
        <li>72</li>
    </ul>

    <!-- url-parameters -->
    <script>
        //restricts if it runs outside an iFrame
        if (window.location.href == window.top.location.href) {
            throw new Error('Forbidden');
        }

        (function() {
            var params = {},
                r = /([^&=]+)=?([^&]*)/g;

            function d(s) {
                return decodeURIComponent(s.replace(/\+/g, ' '));
            }

            var match, search = window.location.search;
            while (match = r.exec(search.substring(1)))
                params[d(match[1])] = d(match[2]);

            window.params = params;
        })();

        window.selectedIcon = params.selectedIcon;

        if (window.selectedIcon) {
            try {
                window.selectedIcon = window.selectedIcon.split('')[0].toUpperCase() + window.selectedIcon.replace(window
                    .selectedIcon.split('').shift(1), '');
            } catch (e) {
                window.selectedIcon = 'Pencil';
            }
        } else {
            window.selectedIcon = 'Pencil';
        }

        var script = document.createElement('script');
        script.src = params.widgetJsURL || 'https://www.webrtc-experiment.com/Canvas-Designer/widget.min.js';
        (document.body || document.documentElement).appendChild(script);
    </script>

    <script src="{{ asset('js/pdf.min.js') }}"></script>
</body>

</html>
