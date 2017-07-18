node {
  stage 'Checkout'
  checkout scm

  stage 'Build'
  if (env.BRANCH_NAME == 'master') {
    def version = sh(script: './version.sh', returnStdout: true)
    sh './build.sh'
    sh 'ls ./build'
    echo "Current version: ${version}"
    sh "git tag ${version}"
    sh "git push --tags"
  }
}
