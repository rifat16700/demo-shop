const fs = require('fs');
const path = require('path');

function walk(dir) {
    fs.readdirSync(dir).forEach(file => {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            if (!['node_modules', '.git', 'hf-api'].includes(file)) walk(fullPath);
        } else if (fullPath.endsWith('.html') || fullPath.endsWith('.js')) {
            let content = fs.readFileSync(fullPath, 'utf8');
            let modified = false;
            
            if (content.includes('CONFIG.HF_API_BASE')) {
                content = content.replace(/CONFIG\.VERCEL_API_BASE/g, 'CONFIG.HF_API_BASE');
                modified = true;
            }
            if (content.includes('CF_D1_READ_TOKEN')) {
                // Remove the Authorization header line dynamically
                content = content.replace(/,\s*['"]Authorization['"]:\s*['"]Bearer\s*['"]\s*\+\s*CONFIG\.CF_D1_READ_TOKEN/g, '');
                content = content.replace(/,\s*['"]Authorization['"]:\s*['"]Bearer\s*['"]\s*\+\s*\(typeof CONFIG !== ['"]undefined['"] \? CONFIG\.CF_D1_READ_TOKEN : ['"]['"]\)/g, '');
                // For stringified headers object
                content = content.replace(/"Authorization":\s*"Bearer "\s*\+\s*CONFIG\.CF_D1_READ_TOKEN\s*,?/g, '');
                modified = true;
            }
            
            if (modified) {
                fs.writeFileSync(fullPath, content);
                console.log('Updated:', fullPath);
            }
        }
    });
}
walk('.');
