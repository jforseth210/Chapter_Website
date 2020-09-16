#Run this script to automatically generate the code for the image caroursel.
import os

template="""\
<div class="swiper-slide">
    <div class="swiper-zoom-container">
        <img src="images/chapter_photos/{}">
    </div>
</div>\
"""
fullscreen_template="""\
<div class="swiper-slide">
    <div class="swiper-zoom-container">
        <img
            src="images/chapter_photos/{}"
            draggable="false" ondragstart="return false;">
    </div>
</div>\
"""
# Create a list of pictures in the folder.
template_type=""
while template_type != 'r' and template_type != 's':
    template_type=input("[r]egular or [f]ullscreen template? (Press 'r' or 'f', followed by the enter key:")
for image in os.listdir('images/chapter_photos/'):
    # Replace the '{}' in the template with the filename of the photo. 
    if template_type == 'r':
        print(template.format(image))
    elif template_type == 'f':
        print(fullscreen_template.format(image))