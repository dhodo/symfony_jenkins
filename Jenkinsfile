pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh "ssh p 2222 dhodo@90.75.148.16 pwd"
            }
        }
        stage('Test') {
            steps {
                echo 'Testing....'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
