# DESIGN.md - みどり内科クリニック（消化器・内視鏡専門）

## 1. Visual Theme & Atmosphere

**Mood**: 上品・信頼・安心。ホテルライクな高級感と医療機関としての清潔感を両立。
**Density**: ゆとりのある余白設計。情報は整理して段階的に提示。
**Philosophy**: 消化器内科・内視鏡内科の専門性を伝えつつ、患者が安心して受診できる温かみのあるデザイン。明朝体ベースで格式と信頼を表現。セクション見出しに英語サブタイトルを配し、洗練された印象を与える。

---

## 2. Color Palette & Roles

| Role | Color | HEX | Usage |
|------|-------|-----|-------|
| Primary | Deep Navy | `#1e3a5f` | ヘッダー、見出し、ナビ、主要テキスト |
| Primary Dark | Dark Navy | `#132840` | ホバー、フッター背景 |
| Accent Gold | Antique Gold | `#b8962e` | 英語サブタイトル、装飾、アクセント |
| Accent Light | Warm Gold | `#d4b85a` | ボタンホバー、ハイライト |
| Sub | Teal Blue | `#5ba4c9` | リンク、タグ、アイコン背景 |
| Background Main | Warm White | `#faf8f4` | メイン背景 |
| Background Alt | Soft Beige | `#f0ece4` | 交互セクション背景 |
| Surface | Pure White | `#ffffff` | カード、コンテンツ背景 |
| Text Primary | Near Black | `#2d2d2d` | 本文テキスト |
| Text Secondary | Warm Gray | `#6b6560` | サブテキスト、キャプション |
| Border | Light Beige | `#e0dbd3` | 区切り線、ボーダー |
| CTA | Deep Green | `#2d7a4f` | CTA電話ボタン |
| LINE | LINE Green | `#06c755` | LINE予約ボタン |

---

## 3. Typography Rules

### Font Family
- **Japanese Heading**: `'Noto Serif JP', serif` (weight: 500-700)
- **Japanese Body**: `'Noto Sans JP', sans-serif` (weight: 300-500)
- **English Heading**: `'Cinzel', serif` (weight: 400-600)
- **English Sub**: `'Cormorant Garamond', serif` (weight: 400)

### Font Size Scale (rem, base 16px)

| Element | PC | SP | Weight | Font |
|---------|----|----|--------|------|
| Hero Catchcopy | 2.8rem | 1.6rem | 500 | Noto Serif JP |
| Section Title (JP) | 2.0rem | 1.5rem | 600 | Noto Serif JP |
| Section Title (EN) | 1.0rem | 0.75rem | 400 | Cinzel |
| H3 | 1.5rem | 1.25rem | 600 | Noto Serif JP |
| Body | 1.0rem | 0.9375rem | 400 | Noto Sans JP |
| Small / Caption | 0.8125rem | 0.75rem | 400 | Noto Sans JP |

### Line Height
- Heading: 1.6
- Body: 2.0 (ゆったりした行間で可読性確保)
- Small: 1.8

### Letter Spacing
- Heading: 0.08em
- Body: 0.04em
- English: 0.12em

### CJK Typography
- `font-feature-settings: "palt"` で和文プロポーショナル
- 禁則処理: `word-break: break-all` は使用しない。`overflow-wrap: break-word` を使用
- 混植: 英数字は Cormorant Garamond / Cinzel、和文は Noto Serif JP / Noto Sans JP

---

## 4. Component Stylings

### Buttons
```
Primary Button:
  background: linear-gradient(135deg, #1e3a5f 0%, #2a5080 100%)
  color: #fff
  padding: 16px 40px
  border-radius: 4px
  font-family: Noto Sans JP
  font-size: 0.9375rem
  letter-spacing: 0.08em
  transition: all 0.3s ease
  hover: translateY(-2px), box-shadow: 0 4px 12px rgba(30,58,95,0.3)

Outline Button:
  background: transparent
  border: 1px solid #1e3a5f
  color: #1e3a5f
  hover: background #1e3a5f, color #fff

CTA Phone Button:
  background: linear-gradient(135deg, #2d7a4f 0%, #3d9960 100%)
  color: #fff
  font-size: 1.25rem
  border-radius: 4px

Gold Accent Button:
  background: linear-gradient(135deg, #b8962e 0%, #d4b85a 100%)
  color: #fff
```

### Cards
```
Feature Card:
  background: #fff
  border-radius: 8px
  box-shadow: 0 2px 20px rgba(0,0,0,0.06)
  padding: 40px 32px
  border-bottom: 3px solid #b8962e
  transition: transform 0.3s, box-shadow 0.3s
  hover: translateY(-4px), box-shadow: 0 8px 30px rgba(0,0,0,0.1)

Blog Card:
  background: #fff
  border-radius: 8px
  overflow: hidden
  box-shadow: 0 2px 16px rgba(0,0,0,0.05)

Medical Card:
  background: #fff
  border-radius: 8px
  overflow: hidden
  border: 1px solid #e0dbd3
  hover: border-color #b8962e
```

### Navigation
```
Header:
  background: rgba(255,255,255,0.95)
  backdrop-filter: blur(10px)
  height: 90px (PC), 64px (SP)
  position: fixed
  box-shadow (on scroll): 0 2px 20px rgba(0,0,0,0.08)

Nav Link:
  font-family: Noto Sans JP
  font-size: 0.875rem
  letter-spacing: 0.06em
  color: #2d2d2d
  hover underline: 2px solid #b8962e (transform scaleX animation)

Nav Link English Sub:
  font-family: Cinzel
  font-size: 0.625rem
  color: #b8962e
  text-transform: uppercase
```

### Forms / Inputs
```
Input:
  border: 1px solid #e0dbd3
  border-radius: 4px
  padding: 12px 16px
  font-size: 1rem
  focus: border-color #1e3a5f, box-shadow: 0 0 0 3px rgba(30,58,95,0.1)
```

### Tables (Timetable)
```
th:
  background: #1e3a5f
  color: #fff
  font-weight: 500
  padding: 12px 16px
  font-size: 0.875rem

td:
  padding: 12px 16px
  border-bottom: 1px solid #e0dbd3
  text-align: center

.open (circle mark):
  color: #1e3a5f
  font-size: 1.25rem

.closed (dash):
  color: #ccc

Saturday column:
  background: rgba(91,164,201,0.08)
```

---

## 5. Layout Principles

### Container
- Max width: 1100px (content), 1200px (wide sections)
- Padding: 0 40px (PC), 0 20px (SP)

### Section Spacing
- Section padding: 100px 0 (PC), 60px 0 (SP)
- Section title margin-bottom: 60px (PC), 40px (SP)

### Grid
- 2 column: 1fr 1fr, gap 48px
- 3 column: repeat(3, 1fr), gap 32px
- 4 column: repeat(4, 1fr), gap 24px

### Section Title Pattern
```html
<div class="section-heading">
  <span class="section-heading-en">English Title</span>
  <h2 class="section-heading-jp">Japanese Title</h2>
</div>
```
- English: Cinzel, gold (#b8962e), uppercase, letter-spacing 0.15em
- Japanese: Noto Serif JP, navy (#1e3a5f), weight 600
- Alignment: center (default), left (for about/greeting sections)

---

## 6. Depth & Elevation

| Level | Shadow | Usage |
|-------|--------|-------|
| Level 0 | none | Flat elements |
| Level 1 | `0 2px 16px rgba(0,0,0,0.05)` | Cards at rest |
| Level 2 | `0 4px 24px rgba(0,0,0,0.08)` | Cards on hover |
| Level 3 | `0 8px 30px rgba(0,0,0,0.1)` | Elevated cards, modals |
| Header | `0 2px 20px rgba(0,0,0,0.08)` | Fixed header (on scroll) |
| CTA | `0 4px 12px rgba(30,58,95,0.3)` | CTA buttons on hover |

### Surface Hierarchy
1. Page background: `#faf8f4`
2. Alt section: `#f0ece4`
3. Card surface: `#ffffff`
4. Overlay: `rgba(30,58,95,0.6)` (hero text overlay)

---

## 7. Do's and Don'ts

### Do's
- Use serif fonts (Noto Serif JP) for headings to convey trust and elegance
- Maintain generous whitespace between sections (100px+)
- Use gold (#b8962e) sparingly as accent, not as primary
- Include English subtitles on every section heading
- Use fade-in animations on scroll (subtle, 0.6s ease)
- Provide timetable in hero area for immediate access
- Use high-quality medical/clinic imagery

### Don'ts
- Don't use bright/saturated colors - keep palette muted and sophisticated
- Don't use sans-serif for main headings
- Don't overcrowd sections - one message per section
- Don't use animation durations over 0.8s (keep subtle)
- Don't use rounded corners over 8px (keep refined, not playful)
- Don't use emoji or casual icons
- Don't use generic stock photos - prefer clinic/medical imagery

---

## 8. Responsive Behavior

### Breakpoints
| Name | Width | Description |
|------|-------|-------------|
| SP | < 768px | Mobile |
| Tablet | 768px - 1024px | Tablet |
| PC | > 1024px | Desktop |

### Mobile Adaptations
- Header: 64px height, hamburger menu (right slide drawer)
- Hero: Full-width, reduced height, centered text
- Grid: 2-col -> 1-col, 3-col -> 1-col
- Section padding: 100px -> 60px
- Font sizes: reduce by ~15-20%
- Fixed bottom CTA bar: phone + WEB reservation (2 buttons)
- Side CTA buttons: hidden on SP

### Touch Targets
- Minimum: 44px x 44px
- Nav items: 48px height
- CTA buttons: 56px height

---

## 9. Agent Prompt Guide

### Color Reference
When generating UI, use these CSS custom properties:
```css
--color-primary: #1e3a5f;
--color-primary-dark: #132840;
--color-accent-gold: #b8962e;
--color-accent-light: #d4b85a;
--color-sub: #5ba4c9;
--color-bg-main: #faf8f4;
--color-bg-alt: #f0ece4;
--color-surface: #ffffff;
--color-text: #2d2d2d;
--color-text-secondary: #6b6560;
--color-border: #e0dbd3;
--color-cta: #2d7a4f;
```

### Prompt Examples
- "Create a medical clinic section with navy heading, gold English subtitle, and beige background"
- "Build a feature card grid with bottom gold border accent and subtle hover elevation"
- "Design a hero slider with fade transition, overlay text in serif font, and semi-transparent timetable"
