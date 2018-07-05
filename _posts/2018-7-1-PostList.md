---
layout: post
title: Post List
date: 2018-07-05 02:38:00
---
<p>Links to all posts on this site:</p>
<ul>
  {% for post in site.posts %}
    <li>
      <a href="{{ post.url }}">{{ post.title }}</a>
    </li>
  {% endfor %}
</ul>
