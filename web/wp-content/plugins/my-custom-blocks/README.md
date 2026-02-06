# My Custom Blocks

A collection of custom Gutenberg blocks for WordPress.

## 📦 Blocks Included

1. **Copyright Date Block** - Displays dynamic copyright date with configurable starting year
2. **Call to Action Block** - Customizable CTA with heading, description, button, and color options

## 📁 Project Structure

```
my-custom-blocks/
├── src/                           ← Source code for all blocks
│   ├── copyright-date/            ← Copyright block source
│   │   ├── index.js               ← Entry point
│   │   ├── edit.js                ← Editor interface
│   │   ├── save.js                ← Frontend output
│   │   ├── block.json             ← Block configuration
│   │   └── render.php             ← Dynamic rendering
│   │
│   └── call-to-action/            ← CTA block source
│       ├── index.js               ← Entry point
│       ├── edit.js                ← Editor interface
│       ├── save.js                ← Frontend output
│       ├── block.json             ← Block configuration
│       ├── style.scss             ← Frontend styles
│       └── editor.scss            ← Editor styles
│
├── build/                         ← Compiled output (auto-generated)
│   ├── copyright-date/            ← Built copyright block
│   │   ├── index.js
│   │   ├── index.asset.php
│   │   ├── block.json
│   │   └── render.php
│   │
│   └── call-to-action/            ← Built CTA block
│       ├── index.js
│       ├── index.asset.php
│       ├── index.css
│       ├── style-index.css
│       └── block.json
│
├── node_modules/                  ← Dependencies (shared by all blocks)
├── package.json                   ← npm configuration
├── webpack.config.js              ← Custom webpack config
└── my-custom-blocks.php           ← Main plugin file
```

## 🚀 Development

### Prerequisites
- Node.js installed in WSL
- WordPress development environment

### Setup
```bash
# Navigate to plugin directory
cd ~/my-wordpress-project/web/wp-content/plugins/my-custom-blocks

# Install dependencies (only once)
npm install
```

### Building

#### Build all blocks (production)
```bash
npm run build
```

#### Development mode with live reload
```bash
npm start
```
This watches for changes and automatically rebuilds!

### Adding a New Block

1. Create new directory in `src/`:
```bash
mkdir src/my-new-block
```

2. Add your block files:
```
src/my-new-block/
├── index.js
├── edit.js
├── save.js
└── block.json
```

3. Update `webpack.config.js`:
```javascript
entry: {
    'copyright-date/index': path.resolve( process.cwd(), 'src/copyright-date/index.js' ),
    'call-to-action/index': path.resolve( process.cwd(), 'src/call-to-action/index.js' ),
    'my-new-block/index': path.resolve( process.cwd(), 'src/my-new-block/index.js' ),
},
```

4. Update `my-custom-blocks.php`:
```php
register_block_type( __DIR__ . '/build/my-new-block' );
```

5. Build:
```bash
npm run build
```

## ✅ Advantages of This Structure

✅ **Shared Dependencies** - One `node_modules/` for all blocks (saves ~250 MB per block!)  
✅ **Single Build Command** - Build all blocks at once  
✅ **Organized** - All custom blocks in one place  
✅ **DRY** - Shared webpack config and tools  
✅ **Easier Maintenance** - Update dependencies once for all blocks  
✅ **Faster Development** - Use `npm start` to watch all blocks  

## 📝 Notes

- All blocks activate/deactivate together (they're in one plugin)
- Only need to run `npm install` once
- Build files are auto-generated - don't edit them directly
- Edit source files in `src/`, then run `npm run build`

## 🔧 Troubleshooting

### Build fails
```bash
# Clean and rebuild
rm -rf node_modules build
npm install
npm run build
```

### Block not showing in editor
1. Check that the plugin is activated
2. Clear browser cache (Ctrl + Shift + R)
3. Check WordPress admin → Tools → Site Health

### Changes not appearing
- Make sure you ran `npm run build` after editing
- Or use `npm start` for auto-rebuild on save

## 📚 Learn More

- [Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [wp-scripts Documentation](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/)
- [Custom Webpack Config](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/#provide-your-own-webpack-config)
