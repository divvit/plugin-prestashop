node {
  stage 'Checkout'
  checkout scm

  stage 'Build'
  if (env.BRANCH_NAME == 'master') {
    sh './build.sh'
    archiveArtifacts artifacts: 'build/*.zip', fingerprint: true
    ls './build'
  }
}
