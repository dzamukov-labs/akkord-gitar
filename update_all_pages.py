#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Скрипт для обновления всех HTML страниц сайта Akkord-gitar.com
"""

import os
import re
from pathlib import Path

# Яндекс.Метрика код
YANDEX_METRIKA = """
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=105821302', 'ym');

    ym(105821302, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/105821302" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
"""

def update_html_file(filepath):
    """Обновляет один HTML файл"""
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        original_content = content
        
        # 1. Обновить DOCTYPE на HTML5
        content = re.sub(
            r'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4\.01 Transitional//EN">\s*<html>',
            '<!DOCTYPE html>\n<html lang="ru">',
            content,
            flags=re.IGNORECASE
        )
        
        # 2. Добавить charset и viewport если их нет
        if '<meta charset=' not in content.lower() and 'charset=UTF-8' in content:
            content = re.sub(
                r'<META content="text/html; charset=UTF-8" http-equiv=Content-Type>',
                '<meta charset="UTF-8">\n<meta name="viewport" content="width=device-width, initial-scale=1.0">',
                content,
                flags=re.IGNORECASE
            )
        
        # 3. Удалить устаревшие META теги
        content = re.sub(
            r'<META content="MSHTML[^>]+>\s*',
            '',
            content,
            flags=re.IGNORECASE
        )
        
        # 4. Исправить META теги на lowercase
        content = re.sub(r'<META ', '<meta ', content)
        content = re.sub(r'<Meta ', '<meta ', content)
        content = re.sub(r' Name=', ' name=', content)
        content = re.sub(r' Content=', ' content=', content)
        
        # 5. Удалить Rambler Top100 в head
        content = re.sub(
            r'<noindex>\s*<!-- begin of Top100 code -->.*?<!-- end of Top100 code -->\s*</noindex>\s*',
            '',
            content,
            flags=re.DOTALL
        )
        
        # 6. Удалить takru_ads контейнеры
        content = re.sub(r'<span id="takru_ads"></span>\s*', '', content)
        content = re.sub(r'<span id="takru_ads2"[^>]*>.*?</span>\s*', '', content, flags=re.DOTALL)
        
        # 7. Удалить ссылку на rusarmia.com
        content = re.sub(
            r'<li><noindex><a rel="nofollow" href="http://rusarmia\.com/"[^>]*>.*?</a></noindex></li>\s*',
            '',
            content,
            flags=re.DOTALL
        )
        
        # 8. Удалить все старые счетчики в footer
        # LiveInternet
        content = re.sub(
            r'<!--LiveInternet counter-->.*?<!--/LiveInternet-->&nbsp;\s*',
            '',
            content,
            flags=re.DOTALL
        )
        
        # Rambler Top100 logo
        content = re.sub(
            r'<!-- begin of Top100 logo -->.*?<!-- end of Top100 logo -->&nbsp;\s*',
            '',
            content,
            flags=re.DOTALL
        )
        
        # Rating@Mail.ru
        content = re.sub(
            r'<!--Rating@Mail\.ru counter-->.*?<!--// Rating@Mail\.ru counter-->\s*',
            '',
            content,
            flags=re.DOTALL
        )
        
        # 9. Обновить copyright
        content = re.sub(
            r'Copyright by Akkord-gitar &copy; 2010-2013',
            'Copyright by Akkord-gitar &copy; 2010-2025',
            content
        )
        
        # 10. Удалить лишние <noindex> теги если они остались пустыми
        content = re.sub(r'<noindex>\s*</noindex>', '', content)
        content = re.sub(r'<noindex>\s*<br>\s*</noindex>', '', content)
        
        # 11. Добавить Яндекс.Метрику перед </head> если её ещё нет
        if 'mc.yandex.ru/metrika/tag.js?id=105821302' not in content:
            content = re.sub(
                r'</head>',
                YANDEX_METRIKA + '\n</head>',
                content,
                count=1
            )
        
        # 12. Убрать устаревшую ссылку "Сделать стартовой"
        content = re.sub(
            r'<a href="http://akkord-gitar\.com"[^>]*setHomePage[^>]*>Сделать стартовой страницей</a>\s*',
            '',
            content
        )
        
        # Сохранить только если были изменения
        if content != original_content:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            return True
        return False
        
    except Exception as e:
        print(f"Ошибка при обработке {filepath}: {e}")
        return False

def main():
    """Главная функция"""
    base_dir = Path(__file__).parent
    
    # Найти все .htm файлы
    htm_files = list(base_dir.rglob('*.htm'))
    
    # Исключить файлы в определенных папках
    exclude_dirs = {'search', 'opr', 'nscript', 'scripts'}
    htm_files = [f for f in htm_files if not any(ex in f.parts for ex in exclude_dirs)]
    
    print(f"Найдено {len(htm_files)} файлов для обработки")
    
    updated_count = 0
    for filepath in htm_files:
        if update_html_file(filepath):
            updated_count += 1
            print(f"✓ Обновлен: {filepath.relative_to(base_dir)}")
    
    print(f"\n{'='*60}")
    print(f"Обработка завершена!")
    print(f"Обновлено файлов: {updated_count} из {len(htm_files)}")
    print(f"{'='*60}")

if __name__ == '__main__':
    main()

