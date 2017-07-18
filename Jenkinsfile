pipeline {
  agent any

  stages {
    stage('Build') {
      steps {
        sh './build.sh'
        archiveArtifacts artifacts: 'build/*.zip'
      }
    }

    stage('Deploy') {
      when {
        expression {
          BRANCH_NAME == 'master'
        }
        echo 'Deploy'
      }
    }

  }
}
