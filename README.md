# Blockive — Premium Addon For Block

A powerful, high-performance, and elegant collection of premium Gutenberg blocks and dynamic **Template Builder** for WordPress. Design websites with advanced layout controls, styling, responsive controls, and dynamic content without external page builders.

---

## Key Highlights

- **Lightweight & High Performance**: Built natively on `@wordpress/scripts` with conditional asset loading—minimal footprint on pages without blocks.
- **Dynamic Template Builder**: Build custom WordPress single post and page templates using dynamic content blocks and conditional display rules.
- **Deep Design Controls**: Advanced typography, responsive spacing (margins/padding), multi-stop gradients, box shadows, text shadows, border styling, and animations.
- **Mobile-First Responsive Design**: Granular controls for desktop, tablet, and mobile breakpoints across all blocks.
- **Accessibility First (A11y)**: Full keyboard navigation, ARIA attributes, and focus management across interactive blocks (Tabs, Accordions, Sliders).
- **SEO & Schema.org**: Built-in structured data generation for FAQ and template blocks.

---

## Included 25 Premium Blocks

| Block Name | Description | Key Customization Features |
|:---|:---|:---|
| **Blockive Accordion** | Collapsible content sections ideal for FAQs and documentation. | Expand/collapse speed, active colors, custom open/close icons, independent styling. |
| **Blockive Business Hours** | Display opening and closing schedules with highlight controls. | Current-day auto-highlighting, typography, row borders, custom time badge format. |
| **Blockive Button** | Customizable button with icon and badge support. | Hover animations, custom badges, icon placement, gradient and solid fills. |
| **Blockive Category List** | Styled taxonomy browser for categories and custom taxonomies. | Hierarchy display, grid/list layouts, post-count badges, custom item spacing. |
| **Blockive Contact Form 7** | Drop-in Contact Form 7 integration with native styling. | Form selection by ID, live preview in editor, custom field and submit button styling. |
| **Blockive Countdown Timer** | Urgency-inducing timers for sales, launches, and events. | Circular & box styles, days/hours/mins/secs labels, expiry actions, styling. |
| **Blockive Drop Caps** | Editorial-style typographic enhancements for standard paragraphs. | First-letter custom padding, custom margins, colored initials, shapes. |
| **Blockive FAQ** | Schema-ready accordion style FAQ lists. | Structured data auto-generation, schema support toggle, icon styles. |
| **Blockive Fun Fact** | Animated milestone statistics and counter block. | Prefix/suffix options, animation speed, layouts, icons, typography. |
| **Blockive Heading** | Titles with gradients, stroke highlights, and shadows. | Text stroke width/color, linear/radial gradients, multi-layer text shadows. |
| **Blockive Icon Box** | Feature card displaying an icon, title, description, and link. | Icon position (top/left/right), hover transitions, border/background options. |
| **Blockive Image Accordion** | Interactive image panels that expand on hover/click. | Custom overlay opacity, animation speed, per-item height, text typography. |
| **Blockive Image Box** | Image card with badges, title, description, and action button. | Image layout modes, hover zoom effects, styling controls. |
| **Blockive Image Comparison** | Draggable before/after slider for visual comparisons. | Keyboard-accessible handle, horizontal/vertical orientation, custom labels. |
| **Blockive Lottie** | Embed lightweight, scalable Lottie vector animations. | Loop, autoplay, speed control, scroll, click, or hover triggers. |
| **Blockive MailChimp** | Capture newsletter signups with a styled Mailchimp subscription form. | API integration, list selection, custom input field and submit button styling. |
| **Blockive Pie Chart** | Interactive data visualizations with pie and donut charts. | Custom legend placement, donut/pie toggle, tooltip formatting (Chart.js). |
| **Blockive Post Grid** | Query-driven grid for showcasing posts, articles, or custom post types. | Custom queries, pagination, category/tag filters, responsive column controls. |
| **Blockive Pricing Table** | Fully customizable pricing table with features list and CTA. | Ribbon/badge, features checklist, period toggles, button styling. |
| **Blockive Progress Bar** | Animated linear progress indicators for skills and goals. | Animated steps, custom bar height, percentage display toggle, stripes. |
| **Blockive Social Icons** | Links to social profiles with custom shapes and animations. | Shape variants (round/circle/square), custom SVG colors, hover animations. |
| **Blockive Tabs** | Content switchers to organize tabular content. | Segmented pill styling, responsive tab layout, keyboard arrow-key navigation. |
| **Blockive Team** | Showcase team members with photos, roles, bios, and social links. | Per-member social links, responsive columns, avatar shape and bio styling. |
| **Blockive Testimonial** | Testimonials slider with star ratings and avatars. | Swiper slider, pausable autoplay, star ratings, avatar styling, navigation arrows. |
| **Blockive Video** | Responsive video embed with custom cover image and lightbox. | Custom cover image, play button design, lightbox modal playback. |

---

## Dynamic Template Builder Blocks

The plugin includes **16 dynamic template blocks** specifically designed for single post and page template design:

| Template Block | Description |
|:---|:---|
| **Post Title** | Dynamic post or page heading with H1–H6 tag selection and typography controls. |
| **Post Content** | Renders post body content with container and layout spacing. |
| **Featured Image** | Dynamic thumbnail image with aspect ratio, border radius, and overlay styling. |
| **Featured Video** | Embeds featured post video formats dynamically. |
| **Author & Author Avatar** | Dynamic author name, biographical info, and circular/square avatar. |
| **Publish Date & Modified Date** | Publication and last updated date formats with custom prefix icons. |
| **Categories & Tags** | Dynamic taxonomy badge lists with custom delimiters and links. |
| **Comments Count** | Dynamic comment count indicator with singular/plural custom labels. |
| **Reading Time** | Calculates and displays reading time estimates based on word count. |
| **Breadcrumbs** | SEO-friendly hierarchical navigation trail. |
| **Previous / Next Navigation** | Post-to-post navigation links with thumbnail previews. |
| **Related Posts** | Dynamic related articles query based on category or tag matches. |
| **Post Meta** | Unified meta container to arrange author, date, and comments in a single line. |

---

## Development Setup

The project uses the official `@wordpress/scripts` toolchain for bundling, linting, and formatting.

### Prerequisites

- **WordPress**: 6.8 or newer
- **PHP**: 7.4 or newer
- **Node.js**: 18.x or newer
- **npm**: 9.x or newer

### Installation & Build Commands

1. Clone the repository into your WordPress plugins directory:
   ```bash
   cd wp-content/plugins/blockive-premium-addon-for-block
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start hot-reloading development server:
   ```bash
   npm run start
   ```

4. Build production assets:
   ```bash
   npm run build
   ```

5. Lint & format code:
   ```bash
   npm run lint:js
   npm run lint:css
   npm run format
   ```

---

## License & Credits

Distributed under the **GPL-2.0-or-later** License. See `readme.txt` or [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html) for details.

Developed by **Mveous**.