'use strict'

class SvgPrint {
  constructor(selector = '.paper svg') {
    if (!document.querySelector(selector)) {
      throw new Error('Invalid selector')
    }

    this.selector = selector
    this.svg = document.querySelector(selector).outerHTML.replace(/[\r|\n]+/g, "\n")
    this.adjustTextQueries = []
  }

  replace(search, replacement) {
    if (search instanceof RegExp) {
      search = new RegExp(search.source, search.flags.replace(/g/g, '') + 'g')
    } else {
      search = search.replace(/[\r|\n]+/g, "\n")

      // @see https://developer.mozilla.org/ja/docs/Web/JavaScript/Guide/Regular_Expressions#escaping
      search = search.replace(/[.*+?^=!:${}()|[\]\/\\]/g, '\\$&')
      search = new RegExp(search, 'g')
    }

    // cast to string
    replacement = replacement !== undefined && replacement !== null ? replacement + '' : ''

    replacement = replacement.replace(/[\r|\n]+/g, "\n")

    this.svg = this.svg.replace(search, replacement)

    return this
  }

  adjustText(selector, textLength = null, textAnchor = 'start') {
    this.adjustTextQueries.push({selector, textLength, textAnchor})

    return this
  }

  adjustTextarea(selector, width, height, lineHeight = 1.2, paddingX = 0.5, paddingY = 0.5, nowrap = false) {
    const doc = new DOMParser().parseFromString(this.svg, 'text/html')
    const textElement = doc.querySelector(selector)
    if (!textElement) {
      return this
    }

    const textSvg = textElement.outerHTML
    // SVGElement doesn't have innerText
    // @see https://developer.mozilla.org/en-US/docs/Web/API/SVGElement
    const textContent = textElement.innerHTML.replace(new RegExp('^<tspan[^>]*>([\\S|\\s]*)</tspan>$'), '$1')

    const adjustedTextSvg = adjustTextarea(textSvg, textContent, width, height, lineHeight, paddingX, paddingY, nowrap)

    this.replace(textSvg, adjustedTextSvg)

    return this
  }

  apply() {
    if (this.svg !== document.querySelector(this.selector).outerHTML) {
      document.querySelector(this.selector).outerHTML = this.svg
    }

    this.adjustTextQueries.forEach(query => {
      // if viewBox is specified, Element.clientWidth and Element.getBoundingClientRect() return different values
      //   clientWidth: ???
      //   getBoundingClientRect(): pure pixel value
      // so this library uses getBoundingClientRect() and pre-calculated ratio to specify the width of some elements
      // @see https://stackoverflow.com/questions/15335926/how-to-use-the-svg-viewbox-attribute
      const $svg = document.querySelector(this.selector)
      const viewBoxWidth = $svg.getAttribute('viewBox')?.split(/ +/)[2] ?? null
      const paperPixelRatio = viewBoxWidth ? parseFloat(viewBoxWidth) / $svg.getBoundingClientRect().width : 1

      adjustText(query.selector, {
        textLength: query.textLength,
        'text-anchor': query.textAnchor,
      }, paperPixelRatio)
    })

    // initialize
    this.svg = document.querySelector(this.selector).outerHTML
    this.adjustTextQueries = []
  }
}

function adjustText (selector, config, paperPixelRatio = 1) {
    const $this = document.getElementById(selector);
  
    if (!$this) {
      return
    }
  
    // shrink text element to specified width
    if (!!config['textLength']) {
      // for firefox
      // @see https://developer.mozilla.org/ja/docs/Web/API/Element/clientWidth
      $this.style.display = 'block'
      if ($this.clientWidth > config.textLength) {
        $this.setAttribute('textLength', config.textLength)
        $this.setAttribute('lengthAdjust', 'spacingAndGlyphs')
      }
    }
  
    // alignment
    if (!!config['text-anchor'] && config['text-anchor'] !== 'start') {
      const w = parseFloat(config['textLength'])
      let x = 0
      let y = 0
      if ($this.getAttribute('transform')) {
        x = parseFloat($this.getAttribute('transform').match(/translate\((\S+) .+\)/)[1])
        y = parseFloat($this.getAttribute('transform').match(/translate\(\S+ (.+)\)/)[1])
      }
  
      if (config['text-anchor'] === 'middle') {
        $this.setAttribute('transform', `translate(${x + (w / 2)} ${y})`)
      }
  
      if (config['text-anchor'] === 'end') {
        $this.setAttribute('transform', `translate(${x + w} ${y})`)
      }
  
      $this.setAttribute('text-anchor', config['text-anchor'])
    }
  }