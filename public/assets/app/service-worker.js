if(!self.define){let s,e={};const n=(n,r)=>(n=new URL(n+".js",r).href,e[n]||new Promise((e=>{if("document"in self){const s=document.createElement("script");s.src=n,s.onload=e,document.head.appendChild(s)}else s=n,importScripts(n),e()})).then((()=>{let s=e[n];if(!s)throw new Error(`Module ${n} didn’t register its module`);return s})));self.define=(r,i)=>{const t=s||("document"in self?document.currentScript.src:"")||location.href;if(e[t])return;let o={};const l=s=>n(s,t),u={module:{uri:t},exports:o,require:l};e[t]=Promise.all(r.map((s=>u[s]||l(s)))).then((s=>(i(...s),o)))}}define(["./workbox-db5fc017"],(function(s){"use strict";s.setCacheNameDetails({prefix:"app"}),self.addEventListener("message",(s=>{s.data&&"SKIP_WAITING"===s.data.type&&self.skipWaiting()})),s.precacheAndRoute([{url:"/assets/app/css/app.678474bf.css",revision:null},{url:"/assets/app/css/chunk-vendors.7f48ba1b.css",revision:null},{url:"/assets/app/index.html",revision:"4277653802d3eef2eb497dca19951277"},{url:"/assets/app/js/app.30425359.js",revision:null},{url:"/assets/app/js/chunk-vendors.ed2861d5.js",revision:null},{url:"/assets/app/manifest.json",revision:"833d8182528a24c31b14f9eb0af10af2"}],{})}));
//# sourceMappingURL=service-worker.js.map
