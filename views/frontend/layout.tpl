<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Image Optimizer - JPEG, PNG, WEBP, GIF</title>
  <link href="{asset file='css/styles.css'}" rel="stylesheet" />
  <link href="{asset file='css/fonts.css'}" rel="stylesheet" />
  <link href="{asset file='font-awesome/css/all.min.css'}" rel="stylesheet" />
  <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Manrope:wght@400;600;900&display=swap" rel="stylesheet">
  {block name='header-code'}{/block}
</head>
<body class="overflow-x-hidden">
{block name='header'}
<div class="navbar bg-base-100 glass">
  <div class="navbar-start">
    <div class="dropdown dropdown-hover">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a>Contact</a></li>
        <li><a>Privacy Policy</a></li>
      </ul>
    </div>
    <a class="btn btn-ghost text-xl font-[Logo]">ImageTools<sup class="badge badge-warning">v1</sup></a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><i class="text-seondary">Image Watermark (coming soon)</i></li>
    </ul>
  </div>
  <div class="navbar-end">
    <input type="checkbox" value="light" class="toggle theme-controller" />
  </div>
</div>
  {/block}
  {block name='body'}{/block}
{block name='footer'}{/block}
<script src="{asset file='font-awesome/js/pro.min.js'}"></script>
</body>
</html>