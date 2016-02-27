## PHP Application Performance debugging with XHProf

This is a docker based PHP application to showcase XHProf. If you like to learn a bit more, you can watch the talk I gave on this project.

[![Talk on Youtube](/resources/video.png)](https://youtu.be/iONsovqzgPw)

### Getting Started
```shell
git clone https://github.com/drpain/xhprof.git
chmod +x install.sh start.sh stop.sh reset.sh
chmod 777 -r src

# Run the install script
./install.sh
```

Open your browser and go to ``http://localhost`` to see the application.

### Info
This project uses a custom framework (Based on SPF), which is as lightweight as possible.

All the examples can be found in the following directory ``src/public/local/templates/examples``
They are loaded from their respective controllers found in ``controllers/controller_*.php``
