<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body ng-app="app" ng-controller="ctrl">

    <input type="file" id="file1">
    <button ng-click="subir()">Upload</button>
    
    <script src="{{asset('/bower_components/angular/angular.min.js')}} "></script>
    <script src="{{asset('/bower_components/angular-ui-uploader/dist/uploader.min.js')}} "></script>

    <script>
        angular.module('app', ['ui.uploader'])
        .controller('ctrl', function($scope, uiUploader, $log){
            $scope.subir = function(){
                uiUploader.startUpload({
                    url: '',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    concurrency: 2,
                    onProgress: function(file) {
                        $log.info(file.name + '=' + file.humanSize);
                        $scope.$apply();
                    },
                    onCompleted: function(file, response) {
                        $log.info(file + 'response' + response);
                    }
                });
            }
            $scope.files = [];
            var element = document.getElementById('file1');
            element.addEventListener('change', function(e) {
                var files = e.target.files;
                uiUploader.addFiles(files);
                $scope.files = uiUploader.getFiles();
                $scope.$apply();
            });
        })
    </script>
</body>
</html>